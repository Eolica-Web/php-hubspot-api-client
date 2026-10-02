<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V2026_09;

use Eolica\Hubspot\Http\Transporter;

final readonly class Crm
{
    public function __construct(private Transporter $transporter) {}

    public function contacts(): Contacts
    {
        return new Contacts($this->transporter);
    }

    public function owners(): Owners
    {
        return new Owners($this->transporter);
    }
}
