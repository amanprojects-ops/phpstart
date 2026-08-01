<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Commands;

use AmanProjects\PhpStart\Console\Input;
use AmanProjects\PhpStart\Console\Output;
use AmanProjects\PhpStart\Application;

/**
 * Version Command
 * 
 * Shows current version or bumps/sets version across all files
 * 
 * Usage:
 *   phpstart version                  Show current version
 *   phpstart version --bump=patch     1.1.0 → 1.1.1
 *   phpstart version --bump=minor     1.1.0 → 1.2.0
 *   phpstart version --bump=major     1.1.0 → 2.0.0
 *   phpstart version --set=2.0.0     Set exact version
 * 
 * @package AmanProjects\PhpStart\Commands
 */
class VersionCommand implements CommandInterface
{
    public function __construct(private Input $input)
    {
    }
    
    public function handle(): void
    {
        $bump = $this->input->getOption('bump');
        $set  = $this->input->getOption('set');
        
        $currentVersion = Application::getVersion();
        
        // Just show version if no flags
        if ($bump === null && $set === null) {
            Output::banner();
            Output::info("Current version: {$currentVersion}");
            Output::line();
            Output::info('Update version:');
            Output::line('  phpstart version --bump=patch     ' . $this->bumpVersion($currentVersion, 'patch'));
            Output::line('  phpstart version --bump=minor     ' . $this->bumpVersion($currentVersion, 'minor'));
            Output::line('  phpstart version --bump=major     ' . $this->bumpVersion($currentVersion, 'major'));
            Output::line('  phpstart version --set=x.y.z      Set exact version');
            Output::line();
            return;
        }
        
        // Calculate new version
        if ($set !== null) {
            if (!preg_match('/^\d+\.\d+\.\d+$/', $set)) {
                Output::error("Invalid version format: {$set}");
                Output::line('  Use semantic versioning: x.y.z (e.g., 1.2.0)');
                exit(1);
            }
            $newVersion = $set;
        } else {
            if (!in_array($bump, ['patch', 'minor', 'major'])) {
                Output::error("Invalid bump type: {$bump}");
                Output::line('  Valid types: patch, minor, major');
                exit(1);
            }
            $newVersion = $this->bumpVersion($currentVersion, $bump);
        }
        
        Output::banner();
        Output::info("Updating version: {$currentVersion} → {$newVersion}");
        Output::line();
        
        // Update Application.php
        $appFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Application.php';
        $this->updateFile(
            $appFile,
            "/private const VERSION = '[^']+'/",
            "private const VERSION = '{$newVersion}'",
            'Application.php'
        );
        
        // Update composer.json
        $composerFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'composer.json';
        $this->updateFile(
            $composerFile,
            '/"version":\s*"[^"]+"/',
            '"version": "' . $newVersion . '"',
            'composer.json'
        );
        
        Output::line();
        Output::success("Version updated to {$newVersion}");
        Output::line();
    }
    
    /**
     * Bump version by type
     */
    private function bumpVersion(string $version, string $type): string
    {
        $parts = explode('.', $version);
        $major = (int) ($parts[0] ?? 0);
        $minor = (int) ($parts[1] ?? 0);
        $patch = (int) ($parts[2] ?? 0);
        
        return match ($type) {
            'major' => ($major + 1) . '.0.0',
            'minor' => $major . '.' . ($minor + 1) . '.0',
            'patch' => $major . '.' . $minor . '.' . ($patch + 1),
            default => $version,
        };
    }
    
    /**
     * Update version in a file using regex
     */
    private function updateFile(string $filePath, string $pattern, string $replacement, string $label): void
    {
        if (!file_exists($filePath)) {
            Output::warning("  Skipped: {$label} (file not found)");
            return;
        }
        
        $content = file_get_contents($filePath);
        $updated = preg_replace($pattern, $replacement, $content, 1, $count);
        
        if ($count > 0 && $updated !== null) {
            file_put_contents($filePath, $updated);
            Output::success("Updated: {$label}");
        } else {
            Output::warning("  Skipped: {$label} (version pattern not found)");
        }
    }
}
