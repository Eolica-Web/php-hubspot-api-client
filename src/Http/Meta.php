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
     * @param array<string, array<string>> $headers
     */
    public static function fromHeaders(array $headers): self
    {
        $headers = array_change_key_case($headers, CASE_LOWER);

        $header = static fn (string $key): ?string => $headers[$key][0] ?? null;

        $correlationId = $header('x-hubspot-correlation-id') ?? $header('x-request-id') ?? '';

        $rateLimit = MetaRateLimit::fromPrimitives([
            'daily' => $header('x-hubspot-ratelimit-daily') ?? '',
            'dailyRemaining' => $header('x-hubspot-ratelimit-daily-remaining') ?? '',
            'intervalMilliseconds' => $header('x-hubspot-ratelimit-interval-milliseconds'),
            'max' => $header('x-hubspot-ratelimit-max'),
            'remaining' => $header('x-hubspot-ratelimit-remaining'),
            'secondly' => $header('x-hubspot-ratelimit-secondly'),
            'secondlyRemaining' => $header('x-hubspot-ratelimit-secondly-remaining'),
        ]);

        return new self($correlationId, $rateLimit);
    }
}
