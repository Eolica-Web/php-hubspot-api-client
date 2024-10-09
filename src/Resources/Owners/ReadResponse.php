<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\Owners;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ReadResponse
{
    /**
     * @param array<array{id: string, name: string, primary: bool}> $teams
     */
    private function __construct(
        public string $id,
        public string $email,
        public string $type,
        public string $firstName,
        public string $lastName,
        public int $userId,
        public int $userIdIncludingInactive,
        public string $createdAt,
        public string $updatedAt,
        public bool $archived,
        public array $teams,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{id: string, email: string, type: string, firstName: string, lastName: string, userId: int, userIdIncludingInactive: int, createdAt: string, updatedAt: string, archived: bool, teams: array<array{id: string, name: string, primary: bool}>}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['id'],
            $response->data['email'],
            $response->data['type'],
            $response->data['firstName'],
            $response->data['lastName'],
            $response->data['userId'],
            $response->data['userIdIncludingInactive'],
            $response->data['createdAt'],
            $response->data['updatedAt'],
            $response->data['archived'],
            $response->data['teams'],
            $response->meta,
        );
    }
}
