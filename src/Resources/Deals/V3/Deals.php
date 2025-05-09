<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Deals\V3;

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
        /** @var Response<array{results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>, paging: array{next: array{after: string, link: string}}}> */
        $response = $this->transporter->get('/crm/v3/objects/deals', [
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
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, associations: array<string, array{results: array<array<string, string>>}>|null}>> */
        $response = $this->transporter->get("/crm/v3/objects/deals/{$id}", [
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
     */
    public function update(string $id, array $properties, ?string $idProperty = null): UpdateResponse
    {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> */
        $response = $this->transporter->patch("/crm/v3/objects/deals/{$id}", [
            'properties' => $properties,
        ], ['idProperty' => $idProperty]);

        return UpdateResponse::fromResponse($response);
    }
}
