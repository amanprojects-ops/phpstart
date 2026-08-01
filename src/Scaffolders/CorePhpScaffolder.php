<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

use AmanProjects\PhpStart\Console\Output;

/**
 * Core PHP Scaffolder
 * 
 * Creates a basic PHP project with routing, database, and MVC structure
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
class CorePhpScaffolder extends BaseScaffolder
{
    public function scaffold(): void
    {
        // Create directory structure
        $this->createDirectoryStructure();
        
        // Generate files from stubs
        $this->generateFiles();
        
        // Generate installer & backup panel
        $this->createInstaller();
        $this->createBackupPanel();
        
        // Initialize git
        $this->initGit();
        
        Output::line();
        Output::success('Core PHP project scaffolded successfully!');
    }
    
    /**
     * Create directory structure
     */
    protected function createDirectoryStructure(): void
    {
        $directories = [
            'public',
            'src/Controllers',
            'src/Models',
            'src/Views/layout',
            'src/Helpers',
            'config',
            'assets/css',
            'assets/js',
            'assets/img',
            'storage/logs',
            'storage/cache',
            'storage/uploads',
            'storage/backups',
            'install',
            'backup',
        ];
        
        $this->createDirectories($directories);
    }
    
    /**
     * Generate files from stubs
     */
    protected function generateFiles(): void
    {
        $stubType = $this->getStubTypePath('core');
        
        // Public files
        $this->writeFile('public/index.php', $this->loadStub($stubType . 'public/index.php.stub'));
        $this->writeFile('public/.htaccess', $this->loadStub($stubType . 'public/.htaccess.stub'));
        
        // Config files
        $this->writeFile('config/config.php', $this->loadStub($stubType . 'config/config.php.stub'));
        $this->writeFile('config/database.php', $this->loadStub($stubType . 'config/database.php.stub'));
        
        // Core files
        $this->writeFile('src/Router.php', $this->loadStub($stubType . 'src/Router.php.stub'));
        $this->writeFile('src/Database.php', $this->loadStub($stubType . 'src/Database.php.stub'));
        
        // Controllers
        $this->writeFile('src/Controllers/HomeController.php', $this->loadStub($stubType . 'src/Controllers/HomeController.php.stub'));
        
        // Models
        $this->writeFile('src/Models/BaseModel.php', $this->loadStub($stubType . 'src/Models/BaseModel.php.stub'));
        
        // Views
        $this->writeFile('src/Views/home.php', $this->loadStub($stubType . 'src/Views/home.php.stub'));
        $this->writeFile('src/Views/layout/header.php', $this->loadStub($stubType . 'src/Views/layout/header.php.stub'));
        $this->writeFile('src/Views/layout/footer.php', $this->loadStub($stubType . 'src/Views/layout/footer.php.stub'));
        
        // Helpers
        $this->writeFile('src/Helpers/functions.php', $this->loadStub($stubType . 'src/Helpers/functions.php.stub'));
        
        // Environment files
        $this->writeFile('.env', $this->loadStub($stubType . '.env.stub'));
        $this->writeFile('.env.example', $this->loadStub($stubType . '.env.example.stub'));
        
        // Git files
        $this->writeFile('.gitignore', $this->loadStub($stubType . '.gitignore.stub'));
        
        // Documentation
        $this->writeFile('README.md', $this->loadStub($stubType . 'README.md.stub'));
    }
}
