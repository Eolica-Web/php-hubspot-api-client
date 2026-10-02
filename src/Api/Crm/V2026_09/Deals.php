<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09;

use Eolica\Hubspot\Api\Crm\V2026_09\Deals\CreateResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Deals\ListResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Deals\ReadResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Deals\UpdateResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Deals extends Resource
{
    /**
     * @param list<string>|null $properties
     * @param list<string>|null $propertiesWithHistory
     * @param list<string>|null $associations
     */
    public function list(
        ?int $limit = null,
        ?string $after = null,
        ?array $properties = null,
        ?array $propertiesWithHistory = null,
        ?array $associations = null,
        ?bool $archived = null,
    ): ListResponse {
        /** @var Response<array{results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>, paging?: array{next: array{after: string, link: string}}}> */
        $response = $this->transporter->get('/crm/objects/2026-09/0-3', [
            'limit' => $limit,
            'after' => $after,
            'properties' => $this->parseListParameter($properties),
            'propertiesWithHistory' => $this->parseListParameter($propertiesWithHistory),
            'associations' => $this->parseListParameter($associations),
            'archived' => $archived,
        ]);

        return ListResponse::fromResponse($response);
    }

    /**
     * @param list<string>|null $properties
     * @param list<string>|null $propertiesWithHistory
     * @param list<string>|null $associations
     */
    public function read(
        string $id,
        ?array $properties = null,
        ?array $propertiesWithHistory = null,
        ?array $associations = null,
        ?bool $archived = null,
        ?string $idProperty = null,
    ): ReadResponse {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, associations: array<string, array{results: array<array<string, string>>}>|null}> */
        $response = $this->transporter->get("/crm/objects/2026-09/0-3/{$id}", [
            'properties' => $this->parseListParameter($properties),
            'propertiesWithHistory' => $this->parseListParameter($propertiesWithHistory),
            'associations' => $this->parseListParameter($associations),
            'archived' => $archived,
            'idProperty' => $idProperty,
        ]);

        return ReadResponse::fromResponse($response);
    }

    /**
     * @param array<string, mixed> $properties
     * @param list<array{types: list<array{associationCategory: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', associationTypeId: int}>, to: array{id: string}}> $associations
     */
    public function create(array $properties, ?array $associations = null): CreateResponse
    {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> */
        $response = $this->transporter->post('/crm/objects/2026-09/0-3', [
            'properties' => $properties,
            'associations' => $associations,
        ]);

        return CreateResponse::fromResponse($response);
    }

    /**
     * @param array<string, mixed> $properties
     */
    public function update(string $id, array $properties, ?string $idProperty = null): UpdateResponse
    {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> */
        $response = $this->transporter->patch("/crm/objects/2026-09/0-3/{$id}", [
            'properties' => $properties,
        ], ['idProperty' => $idProperty]);

        return UpdateResponse::fromResponse($response);
    }
}
