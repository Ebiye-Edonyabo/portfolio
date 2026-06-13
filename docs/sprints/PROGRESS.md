# Portfolio CMS - Progress Tracker

> Last updated: 2026-06-13

## Summary

| Plan | Feature | Backend | Frontend | Tests | Status |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **P1** | Admin Dashboard & CMS | [x] | [/] | [ ] | In Progress |

---

## P1: Admin Dashboard & CMS (In Progress)

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

### Phase 3: Admin Authentication (In Progress)
* **Status:** [/] In Progress
* **Tasks:**
  * [x] Create Livewire component class `App\Livewire\Admin\Login` with proper imports.
  * [x] Create neon-dark login view `resources/views/livewire/admin/login.blade.php`.
  * [ ] Add automated tests for the guest/admin login paths.

### Phase 4: Admin Layout & Routing (Pending)
* **Status:** [ ] Pending
* **Tasks:**
  * [x] Create custom dashboard layout `resources/views/components/layouts/admin.blade.php` with Instrument Sans and FontAwesome.
  * [x] Add `/admin/login` and `/admin` routes in `routes/web.php` with guest/auth middleware.

### Phase 5: Livewire CMS Panels (Pending)
* **Status:** [ ] Pending
* **Tasks:**
  * [x] Create `App\Livewire\Admin\Dashboard` class with CRUD actions.
  * [ ] Create dashboard layout view `resources/views/livewire/admin/dashboard.blade.php` matching the CSS specs.
  * [ ] Build sub-tabs inside the dashboard (Overview, Hero, Tools, Projects, Experiences, Messages).

### Phase 6: HomePage Dynamic Integration (Pending)
* **Status:** [ ] Pending
* **Tasks:**
  * [ ] Refactor `welcome.blade.php` layout to load values dynamically from database models.

### Phase 7: Verification & Testing (Pending)
* **Status:** [ ] Pending
* **Tasks:**
  * [ ] Create `tests/Feature/AdminDashboardTest.php` verifying guest lock, CRUD states, and forms.
  * [ ] Run Pint code formatting (`vendor/bin/pint --dirty`).
