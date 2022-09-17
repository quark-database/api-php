<?php

namespace Anafro\QuarkApi;

use Exception;
use Throwable;

class InstructionResultFormatException extends Exception
{

    /**
     * @param string $message
     */
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message";
    }
}