<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Console;

/**
 * Console Input Parser
 * 
 * Parses command-line arguments from $argv
 * 
 * @package AmanProjects\PhpStart\Console
 */
class Input
{
    private array $argv;
    private array $options = [];
    private array $flags = [];
    
    public function __construct(?array $argv = null)
    {
        $this->argv = $argv ?? $_SERVER['argv'] ?? [];
        $this->parse();
    }
    
    /**
     * Parse arguments into options and flags
     */
    private function parse(): void
    {
        foreach ($this->argv as $arg) {
            if (str_starts_with($arg, '--')) {
                $arg = substr($arg, 2);
                
                if (str_contains($arg, '=')) {
                    [$key, $value] = explode('=', $arg, 2);
                    $this->options[$key] = $value;
                } else {
                    $this->flags[$arg] = true;
                }
            }
        }
    }
    
    /**
     * Get the command name (first argument)
     */
    public function getCommand(): string
    {
        return $this->argv[1] ?? '';
    }
    
    /**
     * Get argument by position
     */
    public function getArgument(int $position): ?string
    {
        return $this->argv[$position] ?? null;
    }
    
    /**
     * Get option value by key
     */
    public function getOption(string $key, ?string $default = null): ?string
    {
        return $this->options[$key] ?? $default;
    }
    
    /**
     * Check if flag exists
     */
    public function hasFlag(string $flag): bool
    {
        return isset($this->flags[$flag]);
    }
    
    /**
     * Get all raw arguments
     */
    public function getRawArgs(): array
    {
        return $this->argv;
    }
    
    /**
     * Get all options
     */
    public function getOptions(): array
    {
        return $this->options;
    }
    
    /**
     * Get all flags
     */
    public function getFlags(): array
    {
        return array_keys($this->flags);
    }
}
