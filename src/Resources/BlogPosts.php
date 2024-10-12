<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Resources;

use Eolica\Hubspot\Http\Transporter;

final readonly class BlogPosts
{
    public function __construct(private Transporter $transporter) {}

    public function v3(): BlogPosts\V3\BlogPosts
    {
        return new BlogPosts\V3\BlogPosts($this->transporter);
    }
}
