<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Http\Transporter;
use Eolica\Hubspot\Resources\Objects\BatchReadResponse;
use Eolica\Hubspot\Resources\Objects\ReadResponse;

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
        /** @var Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>> */
        $response = $this->transporter->get("/crm/v3/objects/{$this->type}/{$id}", [
            'properties' => $this->parseListParameter($properties),
            'propertiesWithHistory' => $this->parseListParameter($propertiesWithHistory),
            'associations' => $this->parseListParameter($associations),
            'archived' => $archived,
            'idProperty' => $idProperty,
        ]);

        return ReadResponse::fromResponse($response);
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
        $response = $this->transporter->post("/crm/v3/objects/{$this->type}/batch/read", [
            'inputs' => $inputs,
            'properties' => $properties,
            'propertiesWithHistory' => $propertiesWithHistory,
            'archived' => $archived,
            'idProperty' => $idProperty,
        ]);

        return BatchReadResponse::fromResponse($response);
    }
}
