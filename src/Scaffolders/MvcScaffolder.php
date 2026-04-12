<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

use AmanProjects\PhpStart\Console\Output;

/**
 * MVC Scaffolder
 * 
 * Creates a full MVC framework with middleware, auth, and session management
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
class MvcScaffolder extends CorePhpScaffolder
{
    public function scaffold(): void
    {
        // Create directory structure
        $this->createDirectoryStructure();
        
        // Generate files from stubs
        $this->generateFiles();
        
        // Generate MVC-specific files
        $this->generateMvcFiles();
        
        // Initialize git
        $this->initGit();
        
        Output::line();
        Output::success('MVC project scaffolded successfully!');
    }
    
    /**
     * Create directory structure
     */
    protected function createDirectoryStructure(): void
    {
        parent::createDirectoryStructure();
        
        $additionalDirectories = [
            'src/Core',
            'src/Middleware',
            'src/Routes',
        ];
        
        $this->createDirectories($additionalDirectories);
    }
    
    /**
     * Generate MVC-specific files
     */
    protected function generateMvcFiles(): void
    {
        $stubType = $this->getStubTypePath('mvc');
        
        // Core framework files
        $this->writeFile('src/Core/App.php', $this->loadStub($stubType . 'src/Core/App.php.stub'));
        $this->writeFile('src/Core/Controller.php', $this->loadStub($stubType . 'src/Core/Controller.php.stub'));
        $this->writeFile('src/Core/Model.php', $this->loadStub($stubType . 'src/Core/Model.php.stub'));
        $this->writeFile('src/Core/View.php', $this->loadStub($stubType . 'src/Core/View.php.stub'));
        $this->writeFile('src/Core/Request.php', $this->loadStub($stubType . 'src/Core/Request.php.stub'));
        $this->writeFile('src/Core/Response.php', $this->loadStub($stubType . 'src/Core/Response.php.stub'));
        $this->writeFile('src/Core/Session.php', $this->loadStub($stubType . 'src/Core/Session.php.stub'));
        $this->writeFile('src/Core/Auth.php', $this->loadStub($stubType . 'src/Core/Auth.php.stub'));
        
        // Middleware
        $this->writeFile('src/Middleware/AuthMiddleware.php', $this->loadStub($stubType . 'src/Middleware/AuthMiddleware.php.stub'));
        
        // Routes
        $this->writeFile('src/Routes/web.php', $this->loadStub($stubType . 'src/Routes/web.php.stub'));
    }
}
