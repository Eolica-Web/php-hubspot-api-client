<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class Associations
{
    public function __construct(private Transporter $transporter) {}

    public function v4(): Associations\V4\Associations
    {
        return new Associations\V4\Associations($this->transporter);
    }
}
