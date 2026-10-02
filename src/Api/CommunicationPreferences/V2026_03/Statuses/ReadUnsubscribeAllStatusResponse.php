<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ReadUnsubscribeAllStatusResponse
{
    /**
     * @param 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING' $status
     * @param array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, timestamp: string, wideStatusType: 'BUSINESS_UNIT_WIDE'|'PORTAL_WIDE', businessUnitId?: int}> $results
     */
    private function __construct(
        public string $status,
        public string $startedAt,
        public string $completedAt,
        public array $results,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, timestamp: string, wideStatusType: 'BUSINESS_UNIT_WIDE'|'PORTAL_WIDE', businessUnitId?: int}>}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['status'],
            $response->data['startedAt'],
            $response->data['completedAt'],
            $response->data['results'],
            $response->meta,
        );
    }
}
