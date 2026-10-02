<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api;

use Eolica\Hubspot\Http\Transporter;

final readonly class Crm
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): Crm\V3\Crm
    {
        return new Crm\V3\Crm($this->transporter);
    }

    public function v4(): Crm\V4\Crm
    {
        return new Crm\V4\Crm($this->transporter);
    }

    public function v2026_09(): Crm\V2026_09\Crm
    {
        return new Crm\V2026_09\Crm($this->transporter);
    }
}
