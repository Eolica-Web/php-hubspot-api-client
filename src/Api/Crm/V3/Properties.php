<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V3;

use Eolica\Hubspot\Api\Crm\V3\Properties\UpdateResponse;
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
        /** @var Response<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}> */
        $response = $this->transporter->get("/crm/v3/properties/{$objectType}/{$property}", [
            'groupName' => $groupName,
            'hidden' => $hidden,
            'options' => $options,
        ]);

        return UpdateResponse::fromResponse($response);
    }
}
