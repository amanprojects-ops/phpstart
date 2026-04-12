<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Commands;

use AmanProjects\PhpStart\Console\Input;
use AmanProjects\PhpStart\Console\Output;

/**
 * List Command
 * 
 * Displays all available project types
 * 
 * @package AmanProjects\PhpStart\Commands
 */
class ListCommand implements CommandInterface
{
    private const TYPES = [
        'core' => [
            'name' => 'Core PHP',
            'description' => 'Basic PHP project with routing, database, and MVC structure',
        ],
        'mvc' => [
            'name' => 'MVC Framework',
            'description' => 'Full MVC framework with middleware, auth, and session management',
        ],
        'api' => [
            'name' => 'REST API',
            'description' => 'RESTful API with JSON responses, CORS, and authentication',
        ],
        'laravel' => [
            'name' => 'Laravel',
            'description' => 'Laravel framework installation with post-setup instructions',
        ],
    ];
    
    public function __construct(private Input $input)
    {
    }
    
    public function handle(): void
    {
        Output::banner();
        Output::info('AVAILABLE PROJECT TYPES:');
        Output::divider();
        
        foreach (self::TYPES as $key => $type) {
            Output::line(sprintf(
                '  %-12s %s',
                "\033[32m" . $key . "\033[0m",
                $type['name']
            ));
            Output::line(sprintf(
                '  %-12s %s',
                '',
                "\033[37m" . $type['description'] . "\033[0m"
            ));
            Output::line();
        }
        
        Output::divider();
        Output::info('USAGE:');
        Output::line('  phpstart new <project-name> --type=<type>');
        Output::line();
        Output::info('EXAMPLE:');
        Output::line('  phpstart new myapp --type=mvc');
        Output::divider();
    }
}
