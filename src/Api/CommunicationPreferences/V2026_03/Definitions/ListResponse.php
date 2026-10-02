<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03\Definitions;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ListResponse
{
    /**
     * @param 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING' $status
     * @param array<array{id: string, name: string, description: string, purpose?: string, communicationMethod?: string, isActive: bool, isDefault: bool, isInternal: bool, businessUnitId?: int, createdAt: string, updatedAt: string, subscriptionTranslations?: array<array{createdAt: int, description: string, languageCode: string, name: string, subscriptionId: int, updatedAt: int}>}> $results
     */
    private function __construct(
        public string $status,
        public string $startedAt,
        public string $completedAt,
        public array $results,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{status: 'CANCELED'|'COMPLETE'|'PENDING'|'PROCESSING', startedAt: string, completedAt: string, results: array<array{id: string, name: string, description: string, purpose?: string, communicationMethod?: string, isActive: bool, isDefault: bool, isInternal: bool, businessUnitId?: int, createdAt: string, updatedAt: string, subscriptionTranslations?: array<array{createdAt: int, description: string, languageCode: string, name: string, subscriptionId: int, updatedAt: int}>}>}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['status'],
            $response->data['startedAt'],
            $response->data['completedAt'],
            $response->data['results'],
            $response->meta,
        );
    }
}
