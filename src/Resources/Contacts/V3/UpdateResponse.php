<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Contacts\V3;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class UpdateResponse
{
    /**
     * @param array<string, string> $properties
     */
    public function __construct(
        public string $id,
        public array $properties,
        public string $createdAt,
        public string $updatedAt,
        public bool $archived,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['id'],
            $response->data['properties'],
            $response->data['createdAt'],
            $response->data['updatedAt'],
            $response->data['archived'],
            $response->meta,
        );
    }
}
