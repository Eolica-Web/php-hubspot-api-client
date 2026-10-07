<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09\Contacts;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class BatchUpsertResponse
{
    /**
     * @param 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING' $status
     * @param array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, new: bool}> $results
     */
    private function __construct(
        public string $status,
        public array $results,
        public string $startedAt,
        public string $completedAt,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool, new: bool}>, startedAt: string, completedAt: string}> $response
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
