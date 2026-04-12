<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Commands;

use AmanProjects\PhpStart\Console\Input;
use AmanProjects\PhpStart\Console\Output;

/**
 * Help Command
 * 
 * Displays usage information and available commands
 * 
 * @package AmanProjects\PhpStart\Commands
 */
class HelpCommand implements CommandInterface
{
    public function __construct(private Input $input)
    {
    }
    
    public function handle(): void
    {
        Output::divider();
        Output::info('USAGE:');
        Output::line('  phpstart <command> [arguments] [options]');
        Output::line();
        
        Output::info('AVAILABLE COMMANDS:');
        Output::line('  new <name>     Create a new PHP project');
        Output::line('  list           List all available project types');
        Output::line('  help           Display this help message');
        Output::line();
        
        Output::info('OPTIONS:');
        Output::line('  --type=<type>  Project type (core, mvc, api, laravel)');
        Output::line('  --force        Overwrite existing directory');
        Output::line('  --no-git       Skip git initialization');
        Output::line('  --author=<name> Set author name in generated files');
        Output::line();
        
        Output::info('EXAMPLES:');
        Output::line('  phpstart new myapp');
        Output::line('  phpstart new myapp --type=mvc');
        Output::line('  phpstart new myapi --type=api');
        Output::line('  phpstart new myblog --type=laravel');
        Output::line('  phpstart new myapp --type=core --no-git');
        Output::line('  phpstart new myapp --force');
        Output::divider();
    }
}
