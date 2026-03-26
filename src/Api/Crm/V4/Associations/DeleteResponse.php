<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V4\Associations;

use Eolica\Hubspot\Http\Meta;
use Eolica\Hubspot\Http\Response;

final readonly class DeleteResponse
{
    private function __construct(public Meta $meta) {}

    /**
     * @param Response<array{}> $response
     */
    public static function fromResponse(Response $response): self
    {
        return new self($response->meta);
    }
}
