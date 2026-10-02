<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api;

use Eolica\Hubspot\Http\Transporter;

final readonly class CommunicationPreferences
{
    public function __construct(private Transporter $transporter) {}

    public function v2026_03(): CommunicationPreferences\V2026_03\CommunicationPreferences
    {
        return new CommunicationPreferences\V2026_03\CommunicationPreferences($this->transporter);
    }
}
