<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Owners\V3;

use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class Owners extends Resource
{
    public function all(?string $email = null, ?int $limit = null, ?string $after = null, ?bool $archived = null): ListResponse
    {
        /** @var Response<array{results: array<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}>, paging?: array{next: array{after: string, link: string}}}> */
        $response = $this->transporter->get('/crm/v3/owners', [
            'email' => $email,
            'limit' => $limit,
            'after' => $after,
            'archived' => $archived,
        ]);

        return ListResponse::fromResponse($response);
    }

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
