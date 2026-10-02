<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\CommunicationPreferences\V2026_03;

use Eolica\Hubspot\Http\Transporter;

final readonly class CommunicationPreferences
{
    public function __construct(private Transporter $transporter) {}

    public function definitions(): Definitions
    {
        return new Definitions($this->transporter);
    }

    public function statuses(): Statuses
    {
        return new Statuses($this->transporter);
    }
}
