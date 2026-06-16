# AGENTS.md — LSP Proyek Asesor

## Project

Laravel 9.2 (PHP 8.1+) — Lembaga Sertifikasi Profesi (professional certification) management system.  
Database: MySQL (`lsp`), root/no password. Auth: Laravel UI (Bootstrap 5) + Sanctum.  
RBAC: Spatie Permission with 3 roles — `admin`, `asesi`, `asesor`.  
PDF: barryvdh/laravel-dompdf. Asset bundler: Laravel Mix (Webpack).

## Roles & route prefixes

| Role   | Prefix              | Middleware              |
|--------|---------------------|-------------------------|
| admin  | `/admin`            | `role:admin`            |
| asesor | `/dashboard-asesor` | `role:asesor`           |
| asesi  | `/dashasesi`        | `auth, role:asesi`      |

Asesor has a **separate login** at `/loginasesor` (not standard `Auth::routes()`).  
Public frontend at `/` handled by `ClientController` and `UiController`.

## Developer commands

```sh
# Serve locally
php artisan serve

# Compile frontend assets (Laravel Mix)
npm run dev          # development build
npm run watch        # watch mode
npm run production   # production build

# Run tests (PHPUnit)
phpunit              # or vendor/bin/phpunit
phpunit tests/Unit   # unit only
phpunit tests/Feature # feature only

# Seed database (run in order: RoleSeeder → ReferensiSeeder → UserSeeder)
php artisan db:seed
php artisan db:seed --class=RoleSeeder        # roles only
php artisan db:seed --class=ReferensiSeeder   # reference data (sex, jurusan, etc.)
php artisan db:seed --class=UserSeeder        # users

# Migrations
php artisan migrate
php artisan migrate:fresh --seed   # reset + seed

# Generate migrations from existing DB (kitloong/laravel-migrations-generator)
php artisan migrate:generate

# Other
php artisan make:model ModelName -m   # model + migration
php artisan storage:link
```

## Key directories

- `app/Models/` — 42 Eloquent models
- `app/Http/Controllers/` — 39 controllers, mostly resource controllers
- `routes/web.php` — all web routes (220 lines, single file)
- `database/migrations/` — 64 migrations (all timestamped `2026_05_*`)
- `database/seeders/` — 5 seeders
- `resources/views/` — blade views organized by role (`admin/`, `asesi/`, `asesor/`, `client/`, `auth/`)
- `public/uploads/` — user-uploaded files directory

## Important quirks

- `phpunit.xml` has DB connection **commented out** for testing — tests don't use in-memory SQLite by default.
- Asesor dashboard routes use `prefix` (not `name` prefix), so route names follow the pattern `dashboard.asesor.*`.
- The `User` model uses `Spatie\Permission\Traits\HasRoles` (not `Authorizable` alone).
- `app/Helpers/MapsHelper.php` — custom helper, not auto-loaded from `composer.json`; include manually if needed.
- `database/migrations_backup/` — older migration snapshots, not actively referenced.
