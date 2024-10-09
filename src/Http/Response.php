<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

/**
 * @template-covariant TData of array
 */
final readonly class Response
{
    /**
     * @param TData $data
     */
    public function __construct(public array $data, public Meta $meta) {}
}
