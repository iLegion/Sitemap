<?php

namespace ilegionxs\Sitemap\Exceptions;

use Exception;
use Throwable;

class InvalidPath extends Exception
{
    public function __construct($message = "Path is not valid.", Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}