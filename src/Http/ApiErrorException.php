<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

use Exception;
use Psr\Http\Message\ResponseInterface;

abstract class ApiErrorException extends Exception
{
    public function __construct(?string $message, public readonly ResponseInterface $response)
    {
        parent::__construct($message ?? $response->getReasonPhrase());
    }
}
