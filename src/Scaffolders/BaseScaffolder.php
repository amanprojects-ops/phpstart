<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Scaffolders;

use AmanProjects\PhpStart\Console\Output;

/**
 * Base Scaffolder
 * 
 * Abstract base class providing common scaffolding functionality
 * 
 * @package AmanProjects\PhpStart\Scaffolders
 */
abstract class BaseScaffolder implements ScaffolderInterface
{
    protected string $stubsPath;
    
    public function __construct(
        protected string $projectName,
        protected string $projectPath,
        protected string $author = 'Developer',
        protected bool $skipGit = false
    ) {
        $this->stubsPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'stubs';
    }
    
    /**
     * Create multiple directories
     */
    protected function createDirectories(array $directories): void
    {
        foreach ($directories as $dir) {
            $fullPath = $this->projectPath . DIRECTORY_SEPARATOR . $dir;
            
            if (!is_dir($fullPath)) {
                if (!mkdir($fullPath, 0755, true)) {
                    Output::error("Failed to create directory: {$dir}");
                    exit(1);
                }
                Output::line("  Created: {$dir}/");
            }
        }
    }
    
    /**
     * Write content to file
     */
    protected function writeFile(string $relativePath, string $content): void
    {
        $fullPath = $this->projectPath . DIRECTORY_SEPARATOR . $relativePath;
        $directory = dirname($fullPath);
        
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        if (file_put_contents($fullPath, $content) === false) {
            Output::error("Failed to write file: {$relativePath}");
            exit(1);
        }
        
        Output::success("Created: {$relativePath}");
    }
    
    /**
     * Load stub file and replace placeholders
     */
    protected function loadStub(string $stubPath, array $replacements = []): string
    {
        $fullPath = $this->stubsPath . DIRECTORY_SEPARATOR . $stubPath;
        
        if (!file_exists($fullPath)) {
            Output::error("Stub file not found: {$stubPath}");
            exit(1);
        }
        
        $content = file_get_contents($fullPath);
        
        // Default replacements
        $defaultReplacements = [
            '{{PROJECT_NAME}}' => $this->projectName,
            '{{NAMESPACE}}' => $this->getNamespace(),
            '{{DATE}}' => date('Y-m-d'),
            '{{YEAR}}' => date('Y'),
            '{{AUTHOR}}' => $this->author,
        ];
        
        $allReplacements = array_merge($defaultReplacements, $replacements);
        
        return str_replace(
            array_keys($allReplacements),
            array_values($allReplacements),
            $content
        );
    }
    
    /**
     * Initialize git repository
     */
    protected function initGit(): void
    {
        if ($this->skipGit) {
            Output::warning('Skipping git initialization (--no-git flag)');
            return;
        }
        
        $currentDir = getcwd();
        chdir($this->projectPath);
        
        exec('git init', $output, $returnCode);
        
        if ($returnCode === 0) {
            exec('git add .');
            exec('git commit -m "Initial commit by phpstart"');
            Output::success('Initialized git repository');
        } else {
            Output::warning('Git initialization failed (git may not be installed)');
        }
        
        chdir($currentDir);
    }
    
    /**
     * Create .env file from stub
     */
    protected function createEnv(string $stubPath = '.env.stub'): void
    {
        $content = $this->loadStub($stubPath);
        $this->writeFile('.env', $content);
    }
    
    /**
     * Get namespace from project name
     */
    protected function getNamespace(): string
    {
        $parts = explode('-', $this->projectName);
        $parts = array_map('ucfirst', $parts);
        return implode('', $parts);
    }
    
    /**
     * Get stub type path
     */
    protected function getStubTypePath(string $type): string
    {
        return $type . DIRECTORY_SEPARATOR;
    }
}
