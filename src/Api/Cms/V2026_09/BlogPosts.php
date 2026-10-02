<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Cms\V2026_09;

use Eolica\Hubspot\Api\Cms\V2026_09\BlogPosts\ListResponse;
use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

final readonly class BlogPosts extends Resource
{
    /**
     * @param list<string>|null $sort
     */
    public function list(
        ?string $after = null,
        ?bool $archived = null,
        ?string $createdAfter = null,
        ?string $createdAt = null,
        ?string $createdBefore = null,
        ?int $limit = null,
        ?string $property = null,
        ?array $sort = null,
        ?string $updatedAfter = null,
        ?string $updatedAt = null,
        ?string $updatedBefore = null,
    ): ListResponse {
        /** @var Response<array{results: array<array{id: string, name: string, featuredImage: string, url: string}>, paging?: array{next: array{after: string, link: string}}, total: int}> */
        $response = $this->transporter->get('/cms/blogs/2026-09/posts', [
            'after' => $after,
            'archived' => $archived,
            'createdAfter' => $createdAfter,
            'createdAt' => $createdAt,
            'createdBefore' => $createdBefore,
            'limit' => $limit,
            'property' => $property,
            'sort' => $this->parseListParameter($sort),
            'updatedAfter' => $updatedAfter,
            'updatedAt' => $updatedAt,
            'updatedBefore' => $updatedBefore,
        ]);

        return ListResponse::fromResponse($response);
    }
}
