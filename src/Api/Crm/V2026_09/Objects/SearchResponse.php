<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09\Objects;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class SearchResponse
{
    /**
     * @param array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}> $results
     * @param array{next?: array{after: string}}|null $paging
     */
    private function __construct(
        public int $total,
        public array $results,
        public ?array $paging,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{total: int, results: array<array{id: string, properties: array<string, string>, createdAt: string, updatedAt: string, archived: bool}>, paging?: array{next?: array{after: string}}}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['total'],
            $response->data['results'],
            $response->data['paging'] ?? null,
            $response->meta,
        );
    }
}
