# Installation Guide

## Quick Start

### 1. Install Dependencies

```bash
composer install
```

### 2. Make Binary Executable

```bash
chmod +x bin/phpstart
```

### 3. Test Locally

```bash
./bin/phpstart help
```

### 4. Install Globally (Optional)

```bash
composer global require amanprojects/phpstart
```

Or link locally for development:

```bash
composer global config repositories.phpstart path /path/to/phpstart
composer global require amanprojects/phpstart:@dev
```

### 5. Verify Installation

```bash
phpstart --version
phpstart help
```

## Usage Examples

### Create Projects

```bash
# Core PHP project
phpstart new mywebsite

# MVC Framework
phpstart new myapp --type=mvc

# REST API
phpstart new myapi --type=api

# Laravel
phpstart new myblog --type=laravel
```

### List Available Types

```bash
phpstart list
```

### Get Help

```bash
phpstart help
```

## Troubleshooting

### Command Not Found

Make sure `~/.composer/vendor/bin` is in your PATH:

```bash
# Add to ~/.bashrc or ~/.zshrc
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

### Permission Denied

Make the binary executable:

```bash
chmod +x bin/phpstart
```

### Autoload Not Found

Run composer install:

```bash
composer install
```

## Development

### Run Tests

```bash
composer test
```

### Update Version

Edit `src/Application.php` and update the VERSION constant.

## Publishing

### To Packagist

1. Create account on https://packagist.org
2. Submit package: https://packagist.org/packages/submit
3. Add GitHub webhook for auto-updates

### Manual Installation

Users can install directly from GitHub:

```bash
composer global require amanprojects/phpstart:dev-main
```

## Requirements

- PHP >= 8.1
- Composer
- Git (optional)

## Support

For issues: https://github.com/amanprojects-ops/phpstart/issues
