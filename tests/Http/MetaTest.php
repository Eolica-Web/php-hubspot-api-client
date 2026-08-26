<?php

declare(strict_types=1);

use Eolica\Hubspot\Http\Meta;

it('parses hubspot rate limit headers', function (): void {
    $meta = Meta::fromHeaders([
        'X-HubSpot-Correlation-Id' => ['abc'],
        'X-HubSpot-RateLimit-Daily' => ['100000'],
        'X-HubSpot-RateLimit-Daily-Remaining' => ['99999'],
        'X-HubSpot-RateLimit-Max' => ['190'],
        'X-HubSpot-RateLimit-Remaining' => ['189'],
    ]);

    expect($meta->correlationId)->toBe('abc')
        ->and($meta->rateLimit->daily)->toBe('100000')
        ->and($meta->rateLimit->dailyRemaining)->toBe('99999')
        ->and($meta->rateLimit->max)->toBe('190')
        ->and($meta->rateLimit->remaining)->toBe('189')
    ;
});

it('does not require daily rate limit headers', function (): void {
    $meta = Meta::fromHeaders([
        'x-request-id' => ['req-1'],
    ]);

    expect($meta->correlationId)->toBe('req-1')
        ->and($meta->rateLimit->daily)->toBe('')
        ->and($meta->rateLimit->dailyRemaining)->toBe('')
        ->and($meta->rateLimit->max)->toBeNull()
    ;
});
