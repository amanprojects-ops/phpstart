<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

use AmanProjects\PhpStart\Console\Output;

/**
 * API Scaffolder
 * 
 * Creates a RESTful API with JSON responses, CORS, and authentication
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
class ApiScaffolder extends BaseScaffolder
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
        Output::success('API project scaffolded successfully!');
    }
    
    /**
     * Create directory structure
     */
    protected function createDirectoryStructure(): void
    {
        $directories = [
            'public',
            'src/Core',
            'src/Controllers/Api',
            'src/Models',
            'src/Middleware',
            'config',
            'storage/logs',
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
        $stubType = $this->getStubTypePath('api');
        
        // Public files
        $this->writeFile('public/index.php', $this->loadStub($stubType . 'public/index.php.stub'));
        $this->writeFile('public/.htaccess', $this->loadStub($stubType . 'public/.htaccess.stub'));
        
        // Core files
        $this->writeFile('src/Core/Router.php', $this->loadStub($stubType . 'src/Core/Router.php.stub'));
        $this->writeFile('src/Core/Request.php', $this->loadStub($stubType . 'src/Core/Request.php.stub'));
        $this->writeFile('src/Core/Response.php', $this->loadStub($stubType . 'src/Core/Response.php.stub'));
        $this->writeFile('src/Core/Middleware.php', $this->loadStub($stubType . 'src/Core/Middleware.php.stub'));
        $this->writeFile('src/Core/Database.php', $this->loadStub($stubType . 'src/Core/Database.php.stub'));
        
        // Controllers
        $this->writeFile('src/Controllers/Api/UserController.php', $this->loadStub($stubType . 'src/Controllers/Api/UserController.php.stub'));
        
        // Models
        $this->writeFile('src/Models/BaseModel.php', $this->loadStub($stubType . 'src/Models/BaseModel.php.stub'));
        
        // Config files
        $this->writeFile('config/config.php', $this->loadStub($stubType . 'config/config.php.stub'));
        $this->writeFile('config/database.php', $this->loadStub($stubType . 'config/database.php.stub'));
        
        // Environment files
        $this->writeFile('.env', $this->loadStub($stubType . '.env.stub'));
        $this->writeFile('.env.example', $this->loadStub($stubType . '.env.example.stub'));
        
        // Git files
        $this->writeFile('.gitignore', $this->loadStub($stubType . '.gitignore.stub'));
        
        // Documentation
        $this->writeFile('README.md', $this->loadStub($stubType . 'README.md.stub'));
    }
}
