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
- 📚 Comprehensive documentation

## Installation

### Global Installation (Recommended)

```bash
composer global require amanprojects/phpstart
```

Make sure `~/.composer/vendor/bin` is in your PATH.

### Local Installation

```bash
composer require amanprojects/phpstart
```

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

## Running Your Project

After creating a project:

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
├── storage/         # Logs, cache, uploads
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
