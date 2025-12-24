# AI Quiz 

The MVP was built entirely in Laravel using Blade templates, following a clean and modular architecture with controller abstraction, service layers, and session-based state management. Laravel was chosen for rapid development, built-in security, and structured code. The MVP successfully handles dynamic patient forms, medication and allergy management, and generates reliable reports, all with reusable and extensible components.

For the MVP, I intentionally used a free, rate-limited AI API (Gemini) to avoid cost while keeping the integration realistic.
The AI layer is abstracted, so switching to a paid provider later is trivial.

## Installation

Use the package manager Composer  and it is Laravel 12

```bash
composer install
php artisan serve
```

## Usage

```.env
in .env please keep GEMINI_API_KEY variable
```



