<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class NotFoundErrorException extends Exception
{
    public function __construct(public readonly ResponseInterface $response)
    {
        parent::__construct($response->getReasonPhrase());
    }
}
