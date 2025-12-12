<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Associations\V4;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ListResponse
{
    /**
     * @param array<array{toObjectId: int, associationTypes: array<array{category: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', typeId: int, label: string|null}>}> $results
     * @param array{next: array{after: string, link: string}}|null $paging
     */
    private function __construct(
        public array $results,
        public ?array $paging,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{results: array<array{toObjectId: int, associationTypes: array<array{category: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', typeId: int, label: string|null}>}>, paging?: array{next: array{after: string, link: string}}}> $response
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
