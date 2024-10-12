<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Owners\V3;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ListResponse
{
    /**
     * @param array<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}> $results
     * @param array{next: array{after: string, link: string}}|null $paging
     */
    private function __construct(
        public array $results,
        public ?array $paging,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{results: array<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}>, paging?: array{next: array{after: string, link: string}}}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['results'],
            $response->data['paging'] ?? null,
            $response->meta,
        );
    }
}
