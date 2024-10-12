<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class Objects
{
    public function __construct(private string $type, private Transporter $transporter) {}

    public function v3(): Objects\V3\Objects
    {
        return new Objects\V3\Objects($this->type, $this->transporter);
    }
}
