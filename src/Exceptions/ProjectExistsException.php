<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Exceptions;

use RuntimeException;

/**
 * Project Exists Exception
 * 
 * Thrown when attempting to create a project in an existing directory
 * 
 * @package AmanProjects\PhpStart\Exceptions
 */
class ProjectExistsException extends RuntimeException
{
    public function __construct(string $projectName)
    {
        parent::__construct(
            "Directory '{$projectName}' already exists. Use --force to overwrite."
        );
    }
}
