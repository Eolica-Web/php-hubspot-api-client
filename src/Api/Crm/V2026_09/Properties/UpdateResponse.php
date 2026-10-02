<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09\Properties;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class UpdateResponse
{
    private function __construct(
        public string $name,
        public Meta $meta,
    ) {}

    /**
     * @param Response<array{name: string}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self(
            $response->data['name'],
            $response->meta,
        );
    }
}
