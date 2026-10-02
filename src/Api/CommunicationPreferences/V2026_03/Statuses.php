<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03;

use Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses\ReadResponse;
use Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses\ReadUnsubscribeAllStatusResponse;
use Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses\UnsubscribeAllResponse;
use Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Statuses\UpdateResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Statuses extends Resource
{
    public function read(string $subscriberIdString, string $channel = 'EMAIL', ?int $businessUnitId = null): ReadResponse
    {
        $subscriberId = rawurlencode($subscriberIdString);

        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, subscriptionId: int, source: string, subscriptionName?: string, setStatusSuccessReason?: 'NO_STATUS_CHANGE'|'REQUESTED_CHANGE_OCCURRED'|'RESUBSCRIBE_OCCURRED'|'UNSUBSCRIBE_FROM_ALL_OCCURRED', legalBasis?: 'CONSENT_WITH_NOTICE'|'LEGITIMATE_INTEREST_CLIENT'|'LEGITIMATE_INTEREST_OTHER'|'LEGITIMATE_INTEREST_PQL'|'NON_GDPR'|'PERFORMANCE_OF_CONTRACT'|'PROCESS_AND_STORE', legalBasisExplanation?: string, businessUnitId?: int, timestamp: string}>}> */
        $response = $this->transporter->get("/communication-preferences/2026-03/statuses/{$subscriberId}", [
            'channel' => $channel,
            'businessUnitId' => $businessUnitId,
        ]);

        return ReadResponse::fromResponse($response);
    }

    /**
     * @param 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED' $statusState
     * @param 'CONSENT_WITH_NOTICE'|'LEGITIMATE_INTEREST_CLIENT'|'LEGITIMATE_INTEREST_OTHER'|'LEGITIMATE_INTEREST_PQL'|'NON_GDPR'|'PERFORMANCE_OF_CONTRACT'|'PROCESS_AND_STORE'|null $legalBasis
     */
    public function update(
        string $subscriberIdString,
        int $subscriptionId,
        string $statusState,
        ?string $legalBasis = null,
        ?string $legalBasisExplanation = null,
        string $channel = 'EMAIL',
    ): UpdateResponse {
        $subscriberId = rawurlencode($subscriberIdString);

        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, subscriptionId: int, source: string, subscriptionName?: string, setStatusSuccessReason?: 'NO_STATUS_CHANGE'|'REQUESTED_CHANGE_OCCURRED'|'RESUBSCRIBE_OCCURRED'|'UNSUBSCRIBE_FROM_ALL_OCCURRED', legalBasis?: 'CONSENT_WITH_NOTICE'|'LEGITIMATE_INTEREST_CLIENT'|'LEGITIMATE_INTEREST_OTHER'|'LEGITIMATE_INTEREST_PQL'|'NON_GDPR'|'PERFORMANCE_OF_CONTRACT'|'PROCESS_AND_STORE', legalBasisExplanation?: string, businessUnitId?: int, timestamp: string}>}> */
        $response = $this->transporter->post("/communication-preferences/2026-03/statuses/{$subscriberId}", [
            'channel' => $channel,
            'subscriptionId' => $subscriptionId,
            'statusState' => $statusState,
            'legalBasis' => $legalBasis,
            'legalBasisExplanation' => $legalBasisExplanation,
        ]);

        return UpdateResponse::fromResponse($response);
    }

    public function readUnsubscribeAllStatus(
        string $subscriberIdString,
        string $channel = 'EMAIL',
        ?int $businessUnitId = null,
        ?bool $verbose = null,
    ): ReadUnsubscribeAllStatusResponse {
        $subscriberId = rawurlencode($subscriberIdString);

        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, timestamp: string, wideStatusType: 'BUSINESS_UNIT_WIDE'|'PORTAL_WIDE', businessUnitId?: int}>}> */
        $response = $this->transporter->get("/communication-preferences/2026-03/statuses/{$subscriberId}/unsubscribe-all", [
            'channel' => $channel,
            'businessUnitId' => $businessUnitId,
            'verbose' => $verbose,
        ]);

        return ReadUnsubscribeAllStatusResponse::fromResponse($response);
    }

    public function unsubscribeAll(
        string $subscriberIdString,
        string $channel = 'EMAIL',
        ?int $businessUnitId = null,
        ?bool $verbose = null,
    ): UnsubscribeAllResponse {
        $subscriberId = rawurlencode($subscriberIdString);

        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{channel: 'EMAIL', status: 'NOT_SPECIFIED'|'SUBSCRIBED'|'UNSUBSCRIBED', subscriberIdString: string, timestamp: string, wideStatusType: 'BUSINESS_UNIT_WIDE'|'PORTAL_WIDE', businessUnitId?: int}>}> */
        $response = $this->transporter->post("/communication-preferences/2026-03/statuses/{$subscriberId}/unsubscribe-all", [], [
            'channel' => $channel,
            'businessUnitId' => $businessUnitId,
            'verbose' => $verbose,
        ]);

        return UnsubscribeAllResponse::fromResponse($response);
    }
}
