<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Exceptions;

use InvalidArgumentException;

/**
 * Invalid Type Exception
 * 
 * Thrown when an unknown project type is specified
 * 
 * @package AmanProjects\PhpStart\Exceptions
 */
class InvalidTypeException extends InvalidArgumentException
{
    public function __construct(string $type)
    {
        parent::__construct(
            "Unknown project type '{$type}'. Run 'phpstart list' to see valid types."
        );
    }
}
