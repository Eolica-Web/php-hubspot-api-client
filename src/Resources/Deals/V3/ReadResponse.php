<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Deals\V3;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ReadResponse
{
    /**
     * @param array<string, string> $properties
     * @param array<string, array{results: array<array<string, string>>}> $associations
     */
    public function __construct(
        public string $id,
        public array $properties,
        public string $createdAt,
        public string $updatedAt,
        public bool $archived,
        public array $associations,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, associations: array<string, array{results: array<array<string, string>>}>|null}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['id'],
            $response->data['properties'],
            $response->data['createdAt'],
            $response->data['updatedAt'],
            $response->data['archived'],
            $response->data['associations'] ?? [],
            $response->meta,
        );
    }
}
