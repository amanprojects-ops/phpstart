# PHPStart - PHP Project Scaffolding CLI

A powerful command-line tool to scaffold production-ready PHP projects in seconds.

## Features

- 🚀 Create complete PHP projects with one command
- 📦 Multiple project types: Core PHP, MVC, REST API, Laravel
- 🎨 Beautiful CLI with colored output
- 🔧 Zero dependencies - pure PHP only
- 📝 Complete with routing, database, and MVC structure
- 🔐 Built-in authentication and session management
- 🌐 REST API with CORS and middleware support
- 🛠️ **Web-Based Installer:** A premium 5-step installer wizard shipped by default for easy setup
- 🔄 **Database Backup Panel:** One-click DB backup and restore utility with auto-rotation
- 🚀 **Version Command:** Manage application & package versions easily via CLI
- 📚 Comprehensive documentation

## Installation

### Step 1 — Install Composer

If you don't have Composer installed, get it first.

**Linux / macOS**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

**Windows**
Download and run the installer from https://getcomposer.org/download
After install, verify:
```bash
composer --version
```

---

### Step 2 — Install PHPStart

#### Option A — Global Installation (Recommended)

Installs `phpstart` as a global command available anywhere on your system.

```bash
composer global require amanprojects/phpstart
```

Then make sure Composer's global bin directory is in your system `PATH`.

**Linux / macOS** — add this to your `~/.bashrc`, `~/.zshrc`, or `~/.profile`:
```bash
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

Reload your shell:
```bash
source ~/.bashrc
# or
source ~/.zshrc
```

**Windows** — add this path to your system environment variables:
```
C:\Users\YourName\phpstart
```

Go to: `Control Panel > System > Advanced System Settings > Environment Variables`
Edit the `Path` variable and add the line above. Then restart your terminal.

Verify the install:
```bash
phpstart help
```

---

#### Option B — Local Installation (Per Project)

Install inside a specific project only.

```bash
composer require amanprojects/phpstart
./vendor/bin/phpstart help
```

---

#### Option C — Clone and Install Manually

```bash
git clone https://github.com/amanprojects-ops/phpstart.git
cd phpstart
composer install
chmod +x bin/phpstart          # Linux/macOS only
php bin/phpstart help
```

To use it globally from a local clone, symlink the binary:

**Linux / macOS**
```bash
sudo ln -s /full/path/to/phpstart/bin/phpstart /usr/local/bin/phpstart
```

**Windows** — add the `bin/` folder path to your system `Path` environment variable.

---

### Step 3 — Verify Installation

```bash
phpstart
phpstart list
phpstart help
```

You should see the ASCII banner and available commands.

## Usage

### Create a New Project

```bash
# Core PHP project (default)
phpstart new myapp

# MVC Framework
phpstart new myapp --type=mvc

# REST API
phpstart new myapi --type=api

# Laravel
phpstart new myblog --type=laravel
```

### Available Commands

```bash
phpstart new <name>     # Create a new project
phpstart list           # List all project types
phpstart version        # View, bump or set application version
phpstart help           # Show help information
```

### Options

- `--type=<type>` - Project type (core, mvc, api, laravel)
- `--force` - Overwrite existing directory
- `--no-git` - Skip git initialization
- `--author=<name>` - Set author name

## Project Types

### Core PHP
Basic PHP project with:
- Simple routing system
- PDO database wrapper
- MVC structure
- Helper functions
- Environment configuration

### MVC Framework
Full MVC framework with:
- Advanced routing
- Middleware support
- Authentication system
- Session management
- Request/Response handlers
- View rendering engine

### REST API
RESTful API with:
- JSON responses
- CORS support
- Bearer token authentication
- Rate limiting
- Error handling
- RESTful routing (GET, POST, PUT, DELETE)

### Laravel
Laravel framework installation with:
- Automatic setup
- Application key generation
- Post-install instructions for Livewire and Filament

## Requirements

- PHP >= 8.1
- Composer
- Git (optional, for git initialization)

## Examples

```bash
# Create a core PHP project
phpstart new mywebsite

# Create an MVC project without git
phpstart new myapp --type=mvc --no-git

# Create an API with custom author
phpstart new myapi --type=api --author="John Doe"

# Force overwrite existing directory
phpstart new myapp --force
```

## Environment Setup Guide

This section covers two things:

1. **System environment** — what your machine needs to run `phpstart`
2. **Project `.env`** — how to configure the app that phpstart generates

---

### Part 1 — System Environment (for phpstart itself)

phpstart is a CLI tool. It does not use a `.env` file itself. Instead it relies on your **system PATH** and installed tools.

#### Required: PHP >= 8.1

Verify your PHP version:

```bash
php --version
# PHP 8.1.x or higher required
```

If PHP is not installed:

| OS | Install |
|----|---------|
| Windows | Download from https://windows.php.net or install XAMPP |
| macOS | `brew install php` |
| Ubuntu/Debian | `sudo apt install php8.1-cli` |
| CentOS/RHEL | `sudo dnf install php` |

Make sure `php` is available in your terminal PATH:

```bash
# Windows — add PHP folder to system Path
# e.g. C:\xampp\php  or  C:\php

# Linux/macOS — usually auto-added, verify with:
which php
```

---

#### Required: Composer

Verify Composer is installed:

```bash
composer --version
# Composer version 2.x.x
```

If not installed:

**Linux / macOS**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Windows**
Download the installer from https://getcomposer.org/download and run it.

---

#### Required: Composer Global Bin in PATH

After installing phpstart globally, the `phpstart` command must be reachable from your terminal.

**Linux / macOS** — add to `~/.bashrc` or `~/.zshrc`:
```bash
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

Reload:
```bash
source ~/.bashrc
```

**Windows** — add this to your system `Path` environment variable:
```
C:\Users\YourName\AppData\Roaming\Composer\vendor\bin
```

Go to: `Control Panel > System > Advanced System Settings > Environment Variables`
Find `Path` under System Variables, click Edit, and add the line above.
Restart your terminal after saving.

Verify:
```bash
phpstart help
```

---

#### Optional: Git

Git is used to auto-initialize a repository after scaffolding. If Git is not installed, phpstart will skip this step with a warning.

```bash
git --version
```

Install Git: https://git-scm.com/downloads

To skip git init when running phpstart:
```bash
phpstart new myapp --no-git
```

---

#### Optional: Composer (for --type=laravel)

The `laravel` type runs `composer create-project` internally. Composer must be installed and available in PATH for this to work.

---

### Part 2 — Project .env Setup (for generated projects)

Every project scaffolded by phpstart includes a `.env` file at the root. This file holds all environment-specific configuration — database credentials, app name, debug mode, etc.

#### Step 1 — Locate Your .env

After running `phpstart new myapp`, your project root will contain:

```
myapp/
├── .env            ← your local config (auto-generated, gitignored)
├── .env.example    ← template with all keys, empty values (safe to commit)
├── public/
├── src/
└── config/
```

If `.env` is missing, recreate it from the example:

```bash
cp .env.example .env
```

---

#### Step 2 — Configure All Variables

Open `.env` and fill in your values:

```env
# ─────────────────────────────────────────
# APPLICATION
# ─────────────────────────────────────────

APP_NAME="My App"
# Name of your application.
# Use double quotes if the name contains spaces.

APP_ENV=development
# Options: development | production | testing
# development → full errors shown, debug enabled
# production  → errors hidden, optimized for live server
# testing     → used during automated tests

APP_URL=http://localhost:8000
# Full base URL. No trailing slash.
# Local dev server  → http://localhost:8000
# XAMPP subfolder   → http://localhost/myapp/public
# Live server       → https://yourdomain.com

APP_DEBUG=true
# true  → show detailed error pages (use in development only)
# false → hide errors from users (always use in production)

APP_TIMEZONE=UTC
# PHP timezone for all date/time functions.
# Examples: UTC | Asia/Karachi | Asia/Dhaka | Europe/London | America/New_York
# Full list → https://www.php.net/manual/en/timezones.php

# ─────────────────────────────────────────
# DATABASE
# ─────────────────────────────────────────

DB_CONNECTION=mysql
# Database driver.
# Supported: mysql | pgsql | sqlite

DB_HOST=127.0.0.1
# Database server hostname.
# Use 127.0.0.1 instead of localhost to avoid socket issues on some systems.

DB_PORT=3306
# MySQL / MariaDB → 3306
# PostgreSQL      → 5432
# SQLite          → leave blank (not applicable)

DB_DATABASE=myapp
# The database name. Must exist before connecting.
# Create it first:
#   CREATE DATABASE myapp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

DB_USERNAME=root
# Database user.
# Use a dedicated non-root user in production.

DB_PASSWORD=
# Database password.
# Leave empty if no password is set (common in local XAMPP/WAMP).
# Wrap in double quotes if it contains special characters:
#   DB_PASSWORD="p@$$w0rd#2024"

DB_CHARSET=utf8mb4
# utf8mb4 supports full Unicode including emojis.
# Only change if your server requires a specific charset.
```

---

#### Step 3 — Environment Profiles

**Local Development (PHP built-in server)**
```env
APP_NAME="My App"
APP_ENV=development
APP_URL=http://localhost:8000
APP_DEBUG=true
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myapp
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
```

**XAMPP / WAMP (subfolder)**
```env
APP_NAME="My App"
APP_ENV=development
APP_URL=http://localhost/myapp/public
APP_DEBUG=true
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myapp
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
```

**Production Server**
```env
APP_NAME="My App"
APP_ENV=production
APP_URL=https://yourdomain.com
APP_DEBUG=false
APP_TIMEZONE=Asia/Karachi

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prod_myapp
DB_USERNAME=db_user
DB_PASSWORD="StrongPassword@2024"
DB_CHARSET=utf8mb4
```

---

#### Step 4 — Reading Variables in Code

Use the built-in `env()` helper anywhere in your project:

```php
// Simple read
$name = env('APP_NAME');

// With fallback default
$host = env('DB_HOST', 'localhost');
$port = env('DB_PORT', '3306');

// Boolean check
$debug = env('APP_DEBUG', 'false') === 'true';

// Inside a class
class Database
{
    public function connect(): PDO
    {
        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
            env('DB_CONNECTION', 'mysql'),
            env('DB_HOST', '127.0.0.1'),
            env('DB_PORT', '3306'),
            env('DB_DATABASE', ''),
            env('DB_CHARSET', 'utf8mb4')
        );

        return new PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'));
    }
}
```

---

#### Step 5 — Common Issues and Fixes

**`env()` returns null for every key**
Your `.env` file is missing or in the wrong location. It must be at the project root, not inside `public/`.

```
myapp/
├── .env        ← correct location
└── public/
    └── index.php
```

**Special characters in password break the connection**
Wrap the value in double quotes:
```env
DB_PASSWORD="p@$$w0rd#special!"
```

**App name with spaces not loading correctly**
Always quote values that contain spaces:
```env
APP_NAME="My Awesome App"
```

**Wrong timezone causing date issues**
Check your current system timezone:
```bash
php -r "echo date_default_timezone_get();"
```
Then set the matching value in `.env`.

**Database connection refused**
- Make sure your database server is running
- Try `127.0.0.1` instead of `localhost`
- Verify the database exists and the user has access

**`phpstart` command not found after global install**
Your Composer global bin is not in PATH. See Part 1 above.

---

#### .env Security Checklist

| Rule | Why |
|------|-----|
| Never commit `.env` to git | Contains passwords and secrets |
| Always commit `.env.example` | Lets teammates know what keys exist |
| Set `APP_DEBUG=false` in production | Prevents leaking stack traces publicly |
| Use a non-root database user in production | Limits damage if credentials are exposed |
| Set file permissions on Linux: `chmod 600 .env` | Prevents other system users from reading it |
| Never place `.env` inside `public/` | It would be directly downloadable via browser |

---

## Running Your Project

After creating a project and configuring `.env`:

```bash
cd myproject
php -S localhost:8000 -t public
```

Visit http://localhost:8000

## Project Structure

```
myproject/
├── public/          # Web root
├── src/             # Application code
│   ├── Controllers/ # Controllers
│   ├── Models/      # Models
│   ├── Views/       # Views
│   └── Helpers/     # Helper functions
├── config/          # Configuration files
├── install/         # Web-based installation wizard
├── backup/          # Database backup & restore panel
├── storage/         # Logs, cache, uploads, backups
└── assets/          # CSS, JS, images
```

## License

MIT License - see LICENSE file for details

## Author

Aman Projects
- Email: contact@amanprojects.com
- GitHub: https://github.com/amanprojects-ops

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For issues and questions, please open an issue on GitHub.

---

Made with ❤️ by Aman Projects
