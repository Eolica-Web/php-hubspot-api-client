<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class Deals
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): Deals\V3\Deals
    {
        return new Deals\V3\Deals($this->transporter);
    }
}
