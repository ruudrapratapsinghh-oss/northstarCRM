# Northstar CRM

Northstar is a Laravel 12 customer relationship management app for tracking leads, contacts, activities, quotations, products, and mail. It includes role-aware lead management, dashboard reporting, API endpoints, email verification, password reset, profile settings, and account deletion.

## Requirements

- PHP 8.2 or newer with PDO MySQL (or SQLite) enabled
- Composer
- Node.js 20 or newer and npm
- MySQL 8/MariaDB, or SQLite for local development

## Local setup

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
npm install
```

For SQLite, create `database/database.sqlite` and use these settings in `.env`:

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

For MySQL, create a database and configure `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`. Never commit `.env` or real credentials.

Run migrations and build the frontend:

```powershell
php artisan migrate
npm run build
```

Start development:

```powershell
php artisan serve
npm run dev
```

Open `http://127.0.0.1:8000`.

## Accounts and roles

Register or create a user through the application, then set its role to `Admin` in the `users` table when elevated lead-management permissions are required. Account settings are available from the signed-in user menu and include profile updates, password changes, email verification, password reset, logout, and account deletion.

Passwords are hashed by Laravel and are never stored in plaintext.

## Useful commands

```powershell
php artisan test
php artisan route:list
php artisan optimize:clear
npm run build
```

## GitHub checklist

Before pushing, confirm `.env`, database files, `node_modules`, `vendor`, logs, and generated build output are ignored. Add a deployment-specific environment file through your hosting platform's secret manager, then run migrations and the production asset build on the target environment.
