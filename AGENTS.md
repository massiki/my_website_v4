# AGENTS.md — my_website_v4

## Stack
- **Laravel 12** + **Livewire 4.2** (no API layer, no Controllers — routes point to Livewire components)
- **Tailwind CSS v4** via `@tailwindcss/vite` plugin (not PostCSS; no `tailwind.config.js`)
- **Vite** via `laravel-vite-plugin` (entry: `resources/css/app.css`, `resources/js/app.js`)

## Setup & dev commands
| Command | What it does |
|---|---|
| `composer run setup` | Full setup: install deps, create `.env`, generate key, migrate, npm install, build assets |
| `composer run dev` | Runs `php artisan serve`, `queue:listen`, `pail` (logs), `npm run dev` concurrently |
| `composer run test` | `artisan config:clear && artisan test` |
| `npx pint` | Laravel Pint (PSR-12 code style fixer, available via require-dev) |

Indentation: 4 spaces (`.editorconfig`). Trim trailing whitespace.

## Architecture
- **All routes** in `routes/web.php` — frontend pages → `App\Livewire\Frontend\*`, admin → `App\Livewire\Admin\*`, auth → `App\Livewire\Auth\Login`
- **Admin prefix** `/admin`, guarded by `auth` + `admin` middleware. Login requires `is_admin = true` on `users` table.
- **Queue / Session / Cache**: all use `database` driver. `php artisan queue:listen` must run (included in `composer run dev`).
- **File uploads**: stored on disk `public`; run `php artisan storage:link` if images don't show.
- **Key-value content**: `home_contents` and `contact_infos` tables use `key` / `value` pattern (models `HomeContent`, `ContactInfo` with static helpers `getValue`/`setValue`).

## Database
- **Local `.env`**: MySQL (`my_website_v4`). **`.env.example`**: SQLite. **Tests**: SQLite `:memory:` (phpunit.xml).
- **No custom Artisan commands** — `app/Console/` is empty.
- **Seeder**: `DatabaseSeeder` creates admin user (`admin@example.com` / `password`), sample projects, services, skills, etc.

## Testing
- PHPUnit with `tests/TestCase` (empty abstract class). No `RefreshDatabase` or `DatabaseTransactions` wired in tests yet. Example tests are boilerplate-only.
- Add `RefreshDatabase` trait to test classes when writing new DB-dependent tests.

## Key models & relationships
- `Project` → `belongsTo(Category)`, `belongsToMany(Technology)` via pivot `project_technology`
- `Category` → `hasMany(Project)`
- All other models (User, Service, Skill, Experience, Education, Message, HomeContent, ContactInfo) are standalone.
- `Service.technologies` is a JSON column (cast to `array`).
