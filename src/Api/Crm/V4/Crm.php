<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V4;

use Eolica\Hubspot\Http\Transporter;

final readonly class Crm
{
    public function __construct(private Transporter $transporter) {}

    public function associations(): Associations
    {
        return new Associations($this->transporter);
    }
}
