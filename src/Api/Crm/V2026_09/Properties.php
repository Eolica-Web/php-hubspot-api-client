<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09;

use Eolica\Hubspot\Api\Crm\V2026_09\Properties\UpdateResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Properties extends Resource
{
    /**
     * @param array<array{hidden: bool, displayOrder?: int, description?: string, label: string, value: string}>|null $options
     */
    public function update(
        string $objectType,
        string $property,
        ?string $groupName = null,
        ?bool $hidden = null,
        ?array $options = null,
    ): UpdateResponse {
        /** @var Response<array{name: string}> */
        $response = $this->transporter->patch("/crm/properties/2026-09/{$objectType}/{$property}", [
            'groupName' => $groupName,
            'hidden' => $hidden,
            'options' => $options,
        ]);

        return UpdateResponse::fromResponse($response);
    }
}
