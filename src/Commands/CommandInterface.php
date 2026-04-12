<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Commands;

/**
 * Command Interface
 * 
 * All commands must implement this interface
 * 
 * @package AmanProjects\PhpStart\Commands
 */
interface CommandInterface
{
    /**
     * Handle the command execution
     */
    public function handle(): void;
}
