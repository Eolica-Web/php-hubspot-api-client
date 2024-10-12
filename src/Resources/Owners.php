<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class Owners
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): Owners\V3\Owners
    {
        return new Owners\V3\Owners($this->transporter);
    }
}
