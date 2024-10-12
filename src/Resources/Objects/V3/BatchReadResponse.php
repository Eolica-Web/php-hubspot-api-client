<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Objects\V3;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class BatchReadResponse
{
    /**
     * @param array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> $results
     */
    private function __construct(
        public string $status,
        public array $results,
        public string $startedAt,
        public string $completedAt,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{status: string, results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>, startedAt: string, completedAt: string}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['status'],
            $response->data['results'],
            $response->data['startedAt'],
            $response->data['completedAt'],
            $response->meta,
        );
    }
}
