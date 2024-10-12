<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources\BlogPosts\V3;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class ListResponse
{
    /**
     * @param array<array{id: string, name: string, featuredImage: string, url: string}> $results
     * @param array{next: array{after: string, link: string}} $paging
     */
    private function __construct(
        public array $results,
        public array $paging,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{results: array<array{id: string, name: string, featuredImage: string, url: string}>, paging: array{next: array{after: string, link: string}}}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['results'],
            $response->data['paging'],
            $response->meta,
        );
    }
}
