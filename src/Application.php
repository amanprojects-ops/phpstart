<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart;

use AmanProjects\PhpStart\Console\Input;
use AmanProjects\PhpStart\Console\Output;
use AmanProjects\PhpStart\Commands\NewCommand;
use AmanProjects\PhpStart\Commands\ListCommand;
use AmanProjects\PhpStart\Commands\HelpCommand;
use AmanProjects\PhpStart\Commands\VersionCommand;
use AmanProjects\PhpStart\Commands\CommandInterface;

/**
 * Main Application Bootstrap
 * 
 * Routes commands and manages application lifecycle
 * 
 * @package AmanProjects\PhpStart
 */
class Application
{
    private const VERSION = '1.1.0';
    
    private Input $input;
    private array $commands = [];
    
    public function __construct()
    {
        $this->input = new Input();
        $this->registerCommands();
    }
    
    /**
     * Register all available commands
     */
    private function registerCommands(): void
    {
        $this->commands = [
            'new' => new NewCommand($this->input),
            'list' => new ListCommand($this->input),
            'help' => new HelpCommand($this->input),
            'version' => new VersionCommand($this->input),
        ];
    }
    
    /**
     * Run the application
     */
    public function run(): void
    {
        $command = $this->input->getCommand();
        
        // Show help if no command provided
        if (empty($command)) {
            Output::banner();
            $this->commands['help']->handle();
            return;
        }
        
        // Route to appropriate command
        if (isset($this->commands[$command])) {
            $this->commands[$command]->handle();
        } else {
            Output::error("Unknown command: {$command}");
            Output::line("Run 'phpstart help' for available commands.");
            exit(1);
        }
    }
    
    /**
     * Get application version
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }
}
