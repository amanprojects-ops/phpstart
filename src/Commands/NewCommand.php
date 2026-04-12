<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Commands;

use AmanProjects\PhpStart\Console\Input;
use AmanProjects\PhpStart\Console\Output;
use AmanProjects\PhpStart\Exceptions\InvalidTypeException;
use AmanProjects\PhpStart\Exceptions\ProjectExistsException;
use AmanProjects\PhpStart\Scaffolders\CorePhpScaffolder;
use AmanProjects\PhpStart\Scaffolders\MvcScaffolder;
use AmanProjects\PhpStart\Scaffolders\ApiScaffolder;
use AmanProjects\PhpStart\Scaffolders\LaravelScaffolder;
use AmanProjects\PhpStart\Scaffolders\ScaffolderInterface;

/**
 * New Command
 * 
 * Creates a new PHP project with specified type
 * 
 * @package AmanProjects\PhpStart\Commands
 */
class NewCommand implements CommandInterface
{
    private const VALID_TYPES = ['core', 'mvc', 'api', 'laravel'];
    
    public function __construct(private Input $input)
    {
    }
    
    public function handle(): void
    {
        // Get project name
        $projectName = $this->input->getArgument(2);
        
        if (empty($projectName)) {
            Output::error('Project name is required.');
            Output::line('Usage: phpstart new <project-name> [--type=<type>]');
            exit(1);
        }
        
        // Get project type
        $type = $this->input->getOption('type', 'core');
        
        // Validate type
        if (!in_array($type, self::VALID_TYPES)) {
            throw new InvalidTypeException($type);
        }
        
        // Check if directory exists
        $projectPath = getcwd() . DIRECTORY_SEPARATOR . $projectName;
        
        if (is_dir($projectPath) && !$this->input->hasFlag('force')) {
            throw new ProjectExistsException($projectName);
        }
        
        // Show banner
        Output::banner();
        
        // Confirm creation
        Output::info("Creating [{$type}] project: {$projectName}");
        Output::line("Location: {$projectPath}");
        Output::line();
        
        if (!Output::confirm("Proceed with project creation?")) {
            Output::warning('Project creation cancelled.');
            exit(0);
        }
        
        Output::line();
        Output::info('Scaffolding project...');
        Output::divider();
        
        // Create scaffolder
        $scaffolder = $this->createScaffolder($type, $projectName, $projectPath);
        
        // Run scaffold
        $scaffolder->scaffold();
        
        // Show success message
        Output::divider();
        Output::success("Project '{$projectName}' created successfully!");
        Output::line();
        Output::info('Next steps:');
        Output::line("  cd {$projectName}");
        
        if ($type === 'laravel') {
            Output::line("  php artisan serve");
        } else {
            Output::line("  php -S localhost:8000 -t public");
        }
        
        Output::line();
        Output::info('Happy coding! 🚀');
        Output::line();
    }
    
    /**
     * Create appropriate scaffolder based on type
     */
    private function createScaffolder(string $type, string $projectName, string $projectPath): ScaffolderInterface
    {
        $author = $this->input->getOption('author', 'Developer');
        $skipGit = $this->input->hasFlag('no-git');
        
        return match ($type) {
            'core' => new CorePhpScaffolder($projectName, $projectPath, $author, $skipGit),
            'mvc' => new MvcScaffolder($projectName, $projectPath, $author, $skipGit),
            'api' => new ApiScaffolder($projectName, $projectPath, $author, $skipGit),
            'laravel' => new LaravelScaffolder($projectName, $projectPath, $author, $skipGit),
            default => throw new InvalidTypeException($type),
        };
    }
}
