<?php

declare(strict_types=1);

namespace AmanProjects\PhpStart\Console;

use AmanProjects\PhpStart\Application;

/**
 * Console Output Helper
 * 
 * Provides colored terminal output using ANSI escape codes
 * 
 * @package AmanProjects\PhpStart\Console
 */
class Output
{
    private const COLOR_RESET = "\033[0m";
    private const COLOR_RED = "\033[31m";
    private const COLOR_GREEN = "\033[32m";
    private const COLOR_YELLOW = "\033[33m";
    private const COLOR_CYAN = "\033[36m";
    private const COLOR_WHITE = "\033[37m";
    private const COLOR_BOLD = "\033[1m";
    
    /**
     * Output info message (cyan)
     */
    public static function info(string $message): void
    {
        echo self::COLOR_CYAN . $message . self::COLOR_RESET . PHP_EOL;
    }
    
    /**
     * Output success message (green)
     */
    public static function success(string $message): void
    {
        echo self::COLOR_GREEN . '✓ ' . $message . self::COLOR_RESET . PHP_EOL;
    }
    
    /**
     * Output warning message (yellow)
     */
    public static function warning(string $message): void
    {
        echo self::COLOR_YELLOW . '⚠ ' . $message . self::COLOR_RESET . PHP_EOL;
    }
    
    /**
     * Output error message (red)
     */
    public static function error(string $message): void
    {
        echo self::COLOR_RED . '✗ ' . $message . self::COLOR_RESET . PHP_EOL;
    }
    
    /**
     * Output plain line
     */
    public static function line(string $message = ''): void
    {
        echo $message . PHP_EOL;
    }
    
    /**
     * Output divider line
     */
    public static function divider(): void
    {
        echo str_repeat('─', 70) . PHP_EOL;
    }
    
    /**
     * Output phpstart banner
     */
    public static function banner(): void
    {
        $version = Application::getVersion();
        $c  = self::COLOR_CYAN;
        $b  = self::COLOR_BOLD;
        $r  = self::COLOR_RESET;
        $y  = self::COLOR_YELLOW;
        $w  = self::COLOR_WHITE;

        echo PHP_EOL;
        echo "{$c}{$b}";
        echo "██████╗ ██╗  ██╗██████╗ ███████╗████████╗ █████╗ ██████╗ ████████╗" . PHP_EOL;
        echo "██╔══██╗██║  ██║██╔══██╗██╔════╝╚══██╔══╝██╔══██╗██╔══██╗╚══██╔══╝" . PHP_EOL;
        echo "██████╔╝███████║██████╔╝███████╗   ██║   ███████║██████╔╝   ██║   " . PHP_EOL;
        echo "██╔═══╝ ██╔══██║██╔═══╝ ╚════██║   ██║   ██╔══██║██╔══██╗   ██║   " . PHP_EOL;
        echo "██║     ██║  ██║██║     ███████║   ██║   ██║  ██║██║  ██║   ██║   " . PHP_EOL;
        echo "╚═╝     ╚═╝  ╚═╝╚═╝     ╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝  " . PHP_EOL;
        echo "{$r}" . PHP_EOL;
        echo "{$y}PHP Project Scaffolding CLI v{$version}{$r}" . PHP_EOL;
        echo "{$w}by AmanProjects | github.com/amanprojects-ops{$r}" . PHP_EOL;
        echo PHP_EOL;
    }
    
    /**
     * Ask for user confirmation
     */
    public static function confirm(string $question, bool $default = true): bool
    {
        $defaultText = $default ? 'Y/n' : 'y/N';
        echo self::COLOR_YELLOW . $question . " [{$defaultText}]: " . self::COLOR_RESET;
        
        $handle = fopen('php://stdin', 'r');
        $line = trim(fgets($handle));
        fclose($handle);
        
        if (empty($line)) {
            return $default;
        }
        
        return strtolower($line) === 'y' || strtolower($line) === 'yes';
    }
}
