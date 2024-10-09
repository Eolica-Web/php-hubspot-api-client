<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

final readonly class Meta
{
    public function __construct(
        public string $correlationId,
        public MetaRateLimit $rateLimit,
    ) {}

    /**
     * @param array{x-hubspot-correlation-id: array<string>, x-hubspot-ratelimit-daily: array<string>, x-hubspot-ratelimit-daily-remaining: array<string>, x-hubspot-ratelimit-interval-milliseconds: array<string>, x-hubspot-ratelimit-max: array<string>, x-hubspot-ratelimit-remaining: array<string>, x-hubspot-ratelimit-secondly: array<string>, x-hubspot-ratelimit-secondly-remaining: array<string>, x-request-id: array<string>} $headers
     */
    public static function fromHeaders(array $headers): self
    {
        $headers = array_change_key_case($headers, CASE_LOWER);

        $correlationId = $headers['x-hubspot-correlation-id'][0];

        $rateLimit = MetaRateLimit::fromPrimitives([
            'daily' => $headers['x-hubspot-ratelimit-daily'][0],
            'dailyRemaining' => $headers['x-hubspot-ratelimit-daily-remaining'][0],
            'intervalMilliseconds' => $headers['x-hubspot-ratelimit-interval-milliseconds'][0],
            'max' => $headers['x-hubspot-ratelimit-max'][0],
            'remaining' => $headers['x-hubspot-ratelimit-remaining'][0],
            'secondly' => $headers['x-hubspot-ratelimit-secondly'][0],
            'secondlyRemaining' => $headers['x-hubspot-ratelimit-secondly-remaining'][0],
        ]);

        return new self($correlationId, $rateLimit);
    }
}
