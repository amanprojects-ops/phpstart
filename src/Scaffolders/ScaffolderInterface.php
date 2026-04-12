<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

/**
 * Scaffolder Interface
 * 
 * All scaffolders must implement this interface
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
interface ScaffolderInterface
{
    /**
     * Scaffold the project structure
     */
    public function scaffold(): void;
}
