<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03;

use Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Definitions\ListResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Definitions extends Resource
{
    public function list(?int $businessUnitId = null, ?bool $includeTranslations = null): ListResponse
    {
        /** @var Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{id: string, name: string, description: string, purpose?: string, communicationMethod?: string, isActive: bool, isDefault: bool, isInternal: bool, businessUnitId?: int, createdAt: string, updatedAt: string, subscriptionTranslations?: array<array{createdAt: int, description: string, languageCode: string, name: string, subscriptionId: int, updatedAt: int}>}>}> */
        $response = $this->transporter->get('/communication-preferences/2026-03/definitions', [
            'businessUnitId' => $businessUnitId,
            'includeTranslations' => $includeTranslations,
        ]);

        return ListResponse::fromResponse($response);
    }
}
