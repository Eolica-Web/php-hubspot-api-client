<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09;

use Eolica\Hubspot\Api\Crm\V2026_09\Associations\CreateResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Associations\DeleteResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Associations\ListResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Associations extends Resource
{
    public function list(string $objectType, string $objectId, string $toObjectType): ListResponse
    {
        /** @var Response<array{results: array<array{toObjectId: int, associationTypes: array<array{category: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', typeId: int, label: string|null}>}>}> */
        $response = $this->transporter->get("/crm/objects/2026-09/{$objectType}/{$objectId}/associations/{$toObjectType}");

        return ListResponse::fromResponse($response);
    }

    public function createDefault(string $objectType, string $objectId, string $toObjectType, string $toObjectId): CreateResponse
    {
        /** @var Response<array{results: array<array{from: array{id: string}, to: array{id: string}, associationSpec: array{associationCategory: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', associationTypeId: int}}>, completedAt: string, startedAt: string, status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING'}> */
        $response = $this->transporter->put("/crm/objects/2026-09/{$objectType}/{$objectId}/associations/default/{$toObjectType}/{$toObjectId}");

        return CreateResponse::fromResponse($response);
    }

    /**
     * @param 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED' $category
     */
    public function create(string $objectType, string $objectId, string $toObjectType, string $toObjectId, string $category, int $typeId): CreateResponse
    {
        /** @var Response<array{results: array<array{from: array{id: string}, to: array{id: string}, associationSpec: array{associationCategory: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', associationTypeId: int}}>, completedAt: string, startedAt: string, status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING'}> */
        $response = $this->transporter->put("/crm/objects/2026-09/{$objectType}/{$objectId}/associations/{$toObjectType}/{$toObjectId}", [
            [
                'associationCategory' => $category,
                'associationTypeId' => $typeId,
            ],
        ]);

        return CreateResponse::fromResponse($response);
    }

    public function delete(string $objectType, string $objectId, string $toObjectType, string $toObjectId): DeleteResponse
    {
        /** @var Response<array{}> */
        $response = $this->transporter->delete("/crm/objects/2026-09/{$objectType}/{$objectId}/associations/{$toObjectType}/{$toObjectId}");

        return DeleteResponse::fromResponse($response);
    }
}
