<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Api\Cms\V2026_09;

use Eolica\Hubspot\Http\Transporter;

final readonly class Cms
{
    public function __construct(private Transporter $transporter) {}

    public function blogPosts(): BlogPosts
    {
        return new BlogPosts($this->transporter);
    }
}
