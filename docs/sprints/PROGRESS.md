# Portfolio CMS - Progress Tracker

> Last updated: 2026-06-13

## Summary

| Plan | Feature | Backend | Frontend | Tests | Status |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **P1** | Admin Dashboard & CMS | [x] | [x] | [x] | Completed |

---

## P1: Admin Dashboard & CMS (Completed)

Umbrella branch: `feature/p1-admin-dashboard-cms`

### Docs
- [x] Plan authored -> `docs/plans/2026-06-13-p1-admin-dashboard-cms.md`
- [x] Design tokens configured -> `DESIGN.md`

### Phase 1: Database Schema & Models (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create migrations for `settings`, `tools`, `projects`, `experiences`, and `messages` tables.
  * [x] Simplify settings table indexes (unique composite key `['group', 'page', 'key']`).
  * [x] Create models `Setting`, `Tool`, `Project`, `Experience`, and `Message` (removed `read_at` field).
  * [x] Configure `DatabaseSeeder.php` to populate admin credentials and Ebiye's portfolio landing contents.
  * [x] Run database migrations and seeders cleanly (`migrate:fresh --seed`).

### Phase 2: Contact Form Database Integration (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Modify homepage `ContactForm.php` Livewire component class to save messages to the database before sending mail notifications.

### Phase 3: Admin Authentication (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create Livewire component class `App\Livewire\Admin\Login` with proper imports.
  * [x] Create neon-dark login view `resources/views/livewire/admin/login.blade.php`.
  * [x] Add automated tests for the guest/admin login paths.

### Phase 4: Admin Layout & Routing (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create custom dashboard layout `resources/views/components/layouts/admin.blade.php` with Instrument Sans and FontAwesome.
  * [x] Add `/admin/login` and `/admin` routes in `routes/web.php` with guest/auth middleware.

### Phase 5: Livewire CMS Panels (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create `App\Livewire\Admin\Dashboard` class with CRUD actions.
  * [x] Create dashboard layout view `resources/views/livewire/admin/dashboard.blade.php` matching the CSS specs.
  * [x] Build sub-tabs inside the dashboard (Overview, Hero, Tools, Projects, Experiences, Messages).

### Phase 6: HomePage Dynamic Integration (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Refactor `welcome.blade.php` layout to load values dynamically from database models.

### Phase 7: Verification & Testing (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create `tests/Feature/AdminDashboardTest.php` verifying guest lock, CRUD states, and forms.
  * [x] Run Pint code formatting (`vendor/bin/pint --dirty`).

### Phase 8: Refactor Overview & Alpine Toggle (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Move statistics and inquiry layout from Overview sub-component inline to Dashboard parent view.
  * [x] Delete `Overview.php` class and `overview.blade.php` view.
  * [x] Refactor CMS sidebar manager sub-links panel to use client-side Alpine toggle (`x-data`, `@click`, `x-show`, `:class`), removing Livewire server round-trips.
  * [x] Add feature test coverage for parent dashboard statistics rendering and tab toggling.
  * [x] Run Pint code formatting (`vendor/bin/pint --dirty`).

### Phase 9: Route-Driven Navigation & Shared Sidebar (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create shared `<x-admin.sidebar>` component that matches Ares Design specs and maps routes.
  * [x] Refactor `layouts.admin` view to provide the sidebar and layout frames for all admin panels.
  * [x] Add separate web routes for `/admin`, `/admin/hero`, `/admin/tools`, `/admin/projects`, `/admin/experiences`, and `/admin/messages`.
  * [x] Add `#[Layout('components.layouts.admin', ['title' => '...'])]` to each component class.
  * [x] Define a new POST `/admin/logout` route and form inside the sidebar.
  * [x] Update test suite to verify route access status codes, Livewire component rendering, and auth/logout redirection.
  * [x] Run Pint code style formatting.

### Phase 10: Livewire Form Objects Refactoring (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Create dedicated Form classes `HeroForm`, `ToolForm`, `ProjectForm`, and `ExperienceForm` extending `Livewire\Form` under `app/Livewire/Forms`.
  * [x] Delegate individual properties, validation attributes, and load/save logic from component classes to their respective form objects.
  * [x] Refactor Livewire views (`hero.blade.php`, `tools.blade.php`, `projects.blade.php`, `experiences.blade.php`) to bind directly to form properties using dot notation.
  * [x] Update the test suite `AdminDashboardTest.php` to target the nested `form.*` paths.
  * [x] Format all modified PHP code using Laravel Pint.

### Phase 11: Forms Folder Relocation (Completed 2026-06-13)
* **Status:** [x] Done
* **Tasks:**
  * [x] Move the `Forms` folder from `app/Livewire/Forms` to `app/Livewire/Admin/Forms`.
  * [x] Update the namespace of `HeroForm`, `ToolForm`, `ProjectForm`, and `ExperienceForm` to `App\Livewire\Admin\Forms`.
  * [x] Update import namespaces inside admin component classes.
  * [x] Verify all feature tests pass successfully.

