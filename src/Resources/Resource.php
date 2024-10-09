<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

abstract readonly class Resource
{
    public function __construct(protected Transporter $transporter) {}

    /**
     * @param array<string>|null $list
     */
    final protected function parseListParameter(?array $list): ?string
    {
        return $list !== null && $list !== [] ? implode(',', $list) : null;
    }
}
