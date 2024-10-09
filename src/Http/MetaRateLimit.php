<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

final readonly class MetaRateLimit
{
    public function __construct(
        public string $daily,
        public string $dailyRemaining,
        public string $intervalMilliseconds,
        public string $max,
        public string $remaining,
        public string $secondly,
        public string $secondlyRemaining,
    ) {}

    /**
     * @param array{daily: string, dailyRemaining: string, intervalMilliseconds: string, max: string, remaining: string, secondly: string, secondlyRemaining: string} $primitives
     */
    public static function fromPrimitives(array $primitives): self
    {
        return new self(
            $primitives['daily'],
            $primitives['dailyRemaining'],
            $primitives['intervalMilliseconds'],
            $primitives['max'],
            $primitives['remaining'],
            $primitives['secondly'],
            $primitives['secondlyRemaining'],
        );
    }
}
