<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Contacts\ReadResponse;
use Eolica\Hubspot\Resources\Contacts\UpdateResponse;

final readonly class Contacts extends Resource
{
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
        $response = $this->transporter->get("/crm/v3/objects/contacts/{$id}", [
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
        $response = $this->transporter->patch("/crm/v3/objects/contacts/{$id}", [
            'properties' => $properties,
        ], ['idProperty' => $idProperty]);

        return UpdateResponse::fromResponse($response);
    }
}
