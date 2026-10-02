<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class UpdateResponse
{
    /**
     * @param 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING' $status
     * @param array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, subscriptionId: int, source: string, subscriptionName?: string, setStatusSuccessReason?: 'NO_STATUS_CHANGE'|'REQUESTED_CHANGE_OCCURRED'|'RESUBSCRIBE_OCCURRED'|'UNSUBSCRIBE_FROM_ALL_OCCURRED', legalBasis?: 'CONSENT_WITH_NOTICE'|'LEGITIMATE_INTEREST_CLIENT'|'LEGITIMATE_INTEREST_OTHER'|'LEGITIMATE_INTEREST_PQL'|'NON_GDPR'|'PERFORMANCE_OF_CONTRACT'|'PROCESS_AND_STORE', legalBasisExplanation?: string, businessUnitId?: int, timestamp: string}> $results
     */
    private function __construct(
        public string $status,
        public string $startedAt,
        public string $completedAt,
        public array $results,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, subscriptionId: int, source: string, subscriptionName?: string, setStatusSuccessReason?: 'NO_STATUS_CHANGE'|'REQUESTED_CHANGE_OCCURRED'|'RESUBSCRIBE_OCCURRED'|'UNSUBSCRIBE_FROM_ALL_OCCURRED', legalBasis?: 'CONSENT_WITH_NOTICE'|'LEGITIMATE_INTEREST_CLIENT'|'LEGITIMATE_INTEREST_OTHER'|'LEGITIMATE_INTEREST_PQL'|'NON_GDPR'|'PERFORMANCE_OF_CONTRACT'|'PROCESS_AND_STORE', legalBasisExplanation?: string, businessUnitId?: int, timestamp: string}>}> $response
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
