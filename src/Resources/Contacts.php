<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class Contacts
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): Contacts\V3\Contacts
    {
        return new Contacts\V3\Contacts($this->transporter);
    }
}
