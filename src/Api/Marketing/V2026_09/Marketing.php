<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Marketing\V2026_09;

use Eolica\Hubspot\Http\Transporter;

final readonly class Marketing
{
    public function __construct(private Transporter $transporter) {}

    public function transactionalEmails(): TransactionalEmails
    {
        return new TransactionalEmails($this->transporter);
    }

    public function emailCampaigns(): EmailCampaigns
    {
        return new EmailCampaigns($this->transporter);
    }
}
