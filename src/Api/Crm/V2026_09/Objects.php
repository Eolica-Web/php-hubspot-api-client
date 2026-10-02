<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09;

use Eolica\Hubspot\Api\Crm\V2026_09\Objects\BatchReadResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Objects\CreateResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Objects\ReadResponse;
use Eolica\Hubspot\Api\Crm\V2026_09\Objects\UpdateResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Http\Transporter;
use Eolica\Hubspot\Resources\Resource;

final readonly class Objects extends Resource
{
    public function __construct(private string $type, Transporter $transporter)
    {
        parent::__construct($transporter);
    }

    /**
     * @param array<string>|null $properties
     * @param array<string>|null $propertiesWithHistory
     * @param array<string>|null $associations
     */
    public function read(
        string $id,
        ?array $properties = null,
        ?array $propertiesWithHistory = null,
        ?array $associations = null,
        ?bool $archived = null,
        ?string $idProperty = null,
    ): ReadResponse {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> */
        $response = $this->transporter->get("/crm/objects/2026-09/{$this->type}/{$id}", [
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
    public function create(array $properties): CreateResponse
    {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, archivedAt: string}> */
        $response = $this->transporter->post("/crm/objects/2026-09/{$this->type}", [
            'properties' => $properties,
        ]);

        return CreateResponse::fromResponse($response);
    }

    /**
     * @param array<string, string> $properties
     */
    public function update(string $id, array $properties, ?string $idProperty = null): UpdateResponse
    {
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, archivedAt: string}> */
        $response = $this->transporter->patch("/crm/objects/2026-09/{$this->type}/{$id}", [
            'properties' => $properties,
        ], ['idProperty' => $idProperty]);

        return UpdateResponse::fromResponse($response);
    }

    /**
     * @param list<array<string, string>> $inputs
     * @param array<string>|null $properties
     * @param array<string>|null $propertiesWithHistory
     */
    public function batchRead(
        array $inputs,
        ?array $properties = null,
        ?array $propertiesWithHistory = null,
        ?bool $archived = null,
        ?string $idProperty = null,
    ): BatchReadResponse {
        /** @var Response<array{status: string, results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>, startedAt: string, completedAt: string}> */
        $response = $this->transporter->post("/crm/objects/2026-09/{$this->type}/batch/read", [
            'inputs' => $inputs,
            'properties' => $properties,
            'propertiesWithHistory' => $propertiesWithHistory,
            'archived' => $archived,
            'idProperty' => $idProperty,
        ]);

        return BatchReadResponse::fromResponse($response);
    }
}
