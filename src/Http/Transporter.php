<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

use Http\Client\Common\HttpMethodsClientInterface;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final readonly class Transporter
{
    public function __construct(private HttpMethodsClientInterface $client) {}

    /**
     * @param array<string, mixed> $parameters
     *
     * @return Response<array<array-key, mixed>>
     */
    public function get(string $path, array $parameters = []): Response
    {
        return $this->parseResponse($this->client->get($this->buildUri($path, $parameters)));
    }

    /**
     * @param array<string, mixed> $body
     * @param array<string, mixed> $parameters
     *
     * @return Response<array<array-key, mixed>>
     */
    public function post(string $path, array $body = [], array $parameters = []): Response
    {
        return $this->parseResponse($this->client->post($this->buildUri($path, $parameters), body: $this->parseBody($body)));
    }

    /**
     * @param array<string, mixed> $body
     * @param array<string, mixed> $parameters
     *
     * @return Response<array<array-key, mixed>>
     */
    public function put(string $path, array $body = [], array $parameters = []): Response
    {
        return $this->parseResponse($this->client->put($this->buildUri($path, $parameters), body: $this->parseBody($body)));
    }

    /**
     * @param array<string, mixed> $body
     * @param array<string, mixed> $parameters
     *
     * @return Response<array<array-key, mixed>>
     */
    public function patch(string $path, array $body = [], array $parameters = []): Response
    {
        return $this->parseResponse($this->client->patch($this->buildUri($path, $parameters), body: $this->parseBody($body)));
    }

    /**
     * @param array<string, mixed> $parameters
     *
     * @return Response<array<array-key, mixed>>
     */
    public function delete(string $path, array $parameters = []): Response
    {
        return $this->parseResponse($this->client->delete($this->buildUri($path, $parameters)));
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function buildUri(string $path, array $parameters = []): string
    {
        if ($parameters !== []) {
            $path .= '?'.http_build_query($parameters, encoding_type: PHP_QUERY_RFC3986);
        }

        return $path;
    }

    /**
     * @param array<string, mixed> $body
     */
    private function parseBody(array $body): string
    {
        // @var string
        return json_encode($body, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @return Response<array<array-key, mixed>>
     *
     * @throws NotFoundErrorException
     * @throws UnserializableResponseException
     * @throws RuntimeException
     */
    private function parseResponse(ResponseInterface $response): Response
    {
        if ($response->getStatusCode() === 404) {
            throw new NotFoundErrorException($response);
        }

        $data = $this->unserializeResponseBody($response);

        /** @var array{x-hubspot-correlation-id: array<string>, x-hubspot-ratelimit-daily: array<string>, x-hubspot-ratelimit-daily-remaining: array<string>, x-hubspot-ratelimit-interval-milliseconds: array<string>, x-hubspot-ratelimit-max: array<string>, x-hubspot-ratelimit-remaining: array<string>, x-hubspot-ratelimit-secondly: array<string>, x-hubspot-ratelimit-secondly-remaining: array<string>, x-request-id: array<string>} */
        $headers = $response->getHeaders();

        return new Response($data, Meta::fromHeaders($headers));
    }

    /**
     * @return array<array-key, mixed>
     */
    private function unserializeResponseBody(ResponseInterface $response): array
    {
        if ($response->getStatusCode() === 204) {
            return [];
        }

        try {
            /** @var array{message: string, category: string} $data */
            $data = json_decode($response->getBody()->getContents(), associative: true, flags: JSON_THROW_ON_ERROR);

            if ($response->getStatusCode() >= 400) {
                throw match ($response->getStatusCode()) {
                    401 => new UnauthorizedErrorException($data['message'], $response),
                    403 => new ForbiddenErrorException($data['message'], $response),
                    default => new RuntimeException($data['message'], $response->getStatusCode()),
                };
            }
        } catch (JsonException $e) {
            throw new UnserializableResponseException($e);
        }

        return $data;
    }
}
