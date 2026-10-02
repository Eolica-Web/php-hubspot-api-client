<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09\Associations;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ListLabelsResponse
{
    /**
     * @param array<array{category: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED'|'WORK', typeId: int, label?: string|null, fromObjectTypeId?: string, toObjectTypeId?: string}> $results
     */
    private function __construct(
        public array $results,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{results: array<array{category: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED'|'WORK', typeId: int, label?: string|null, fromObjectTypeId?: string, toObjectTypeId?: string}>}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['results'],
            $response->meta,
        );
    }
}
