<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Crm\V3;

use Eolica\Hubspot\Http\Transporter;

final readonly class Crm
{
    public function __construct(private Transporter $transporter) {}

    public function contacts(): Contacts
    {
        return new Contacts($this->transporter);
    }

    public function deals(): Deals
    {
        return new Deals($this->transporter);
    }

    public function objects(string $type): Objects
    {
        return new Objects($type, $this->transporter);
    }

    public function properties(): Properties
    {
        return new Properties($this->transporter);
    }

    public function owners(): Owners
    {
        return new Owners($this->transporter);
    }
}
