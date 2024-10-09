<?php

declare(strict_types=1);

namespace Eolica\Hubspot\Http;

use Exception;
use JsonException;

final class UnserializableResponseException extends Exception
{
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), $exception->getCode(), $exception);
    }
}
