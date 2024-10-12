<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\BlogPosts\V3;

use Eolica\Hubspot\Http\Response;
use Eolica\Hubspot\Resources\Resource;

use function Eolica\Hubspot\array_map_with_keys;

final readonly class BlogPosts extends Resource
{
    /**
     * @param array<array{field: 'archivedAt'|'blogAuthorId'|'campaign'|'contentGroupId'|'createdAt'|'createdById'|'id'|'name'|'publishDate'|'slug'|'state'|'tagId'|'translatedFromId'|'updatedAt'|'updatedById', operator: string, value: mixed}> $filters
     * @param 'DRAFT'|'PUBLISHED'|'SCHEDULED' $state
     */
    public function list(
        ?array $filters = null,
        ?string $state = null,
        ?string $sort = null,
        ?string $after = null,
        ?int $limit = null,
        ?bool $archived = null,
    ): ListResponse {
        $filters = $filters !== null ? array_map_with_keys(fn (array $filter): array => ["{$filter['field']}__{$filter['operator']}" => $filter['value']], $filters) : [];

        /** @var Response<array{results: array<array{id: string, name: string, featuredImage: string, url: string}>, paging: array{next: array{after: string, link: string}}}> */
        $response = $this->transporter->get('/cms/v3/blogs/posts', [
            ...$filters,
            'state' => $state,
            'sort' => $sort,
            'after' => $after,
            'limit' => $limit,
            'archived' => $archived,
        ]);

        return ListResponse::fromResponse($response);
    }
}
