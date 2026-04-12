<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

use AmanProjects\PhpStart\Console\Output;

/**
 * Laravel Scaffolder
 * 
 * Installs Laravel framework using Composer
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
class LaravelScaffolder extends BaseScaffolder
{
    public function scaffold(): void
    {
        Output::info('Installing Laravel via Composer...');
        Output::line('This may take a few minutes...');
        Output::line();
        
        // Run composer create-project
        $command = sprintf(
            'composer create-project laravel/laravel %s',
            escapeshellarg($this->projectName)
        );
        
        passthru($command, $returnCode);
        
        if ($returnCode !== 0) {
            Output::error('Laravel installation failed. Make sure Composer is installed.');
            exit(1);
        }
        
        Output::line();
        Output::success('Laravel installed successfully!');
        
        // Generate application key
        Output::info('Generating application key...');
        $currentDir = getcwd();
        chdir($this->projectPath);
        
        passthru('php artisan key:generate');
        
        chdir($currentDir);
        
        // Show post-install instructions
        $this->showPostInstallInstructions();
        
        // Initialize git if not skipped
        $this->initGit();
    }
    
    /**
     * Show post-install instructions
     */
    private function showPostInstallInstructions(): void
    {
        Output::line();
        Output::divider();
        Output::info('OPTIONAL ENHANCEMENTS:');
        Output::line();
        Output::line('Install Livewire:');
        Output::line('  composer require livewire/livewire');
        Output::line();
        Output::line('Install Filament Admin Panel:');
        Output::line('  composer require filament/filament');
        Output::line('  php artisan make:filament-user');
        Output::line();
        Output::divider();
    }
}
