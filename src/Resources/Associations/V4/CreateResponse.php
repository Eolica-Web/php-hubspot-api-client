<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Associations\V4;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class CreateResponse
{
    /**
     * @param array<array{from: array{id: string}, to: array{id: string}, associationSpec: array{associationCategory: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', associationTypeId: int}}> $results
     * @param 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING' $status
     */
    private function __construct(
        public array $results,
        public string $completedAt,
        public string $startedAt,
        public string $status,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{results: array<array{from: array{id: string}, to: array{id: string}, associationSpec: array{associationCategory: 'HUBSPOT_DEFINED'|'INTEGRATOR_DEFINED'|'USER_DEFINED', associationTypeId: int}}>, completedAt: string, startedAt: string, status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING'}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['results'],
            $response->data['completedAt'],
            $response->data['startedAt'],
            $response->data['status'],
            $response->meta,
        );
    }
}
