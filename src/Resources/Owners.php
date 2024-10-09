<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Owners\ReadResponse;

final readonly class Owners extends Resource
{
    public function read(string $id, ?bool $archived = null, ?string $idProperty = null): ReadResponse
    {
        /** @var Response<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}> */
        $response = $this->transporter->get("/crm/v3/owners/{$id}", [
            'archived' => $archived,
            'idProperty' => $idProperty,
        ]);

        return ReadResponse::fromResponse($response);
    }
}
