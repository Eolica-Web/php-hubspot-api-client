<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api;

use Eolica\Hubspot\Http\Transporter;

final readonly class Cms
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): Cms\V3\Cms
    {
        return new Cms\V3\Cms($this->transporter);
    }
}
