<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api;

use Eolica\Hubspot\Http\Transporter;

final readonly class Marketing
{
    public function __construct(private Transporter $transporter) {}

    public function v2026_09(): Marketing\V2026_09\Marketing
    {
        return new Marketing\V2026_09\Marketing($this->transporter);
    }
}
