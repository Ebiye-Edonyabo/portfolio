# Implementation Plan - Admin Dashboard & CMS

This plan details the design, database schema, and step-by-step changes to convert Ebiye's portfolio landing page into a dynamic **Content Management System (CMS)** managed via a secure admin dashboard.

The dashboard layout and component styling will strictly adhere to the [DESIGN.md](file:///c:/Users/EBI/Develop/others/portfolio/DESIGN.md) document.

---

## User Review Required

> [!IMPORTANT]
> **CMS Settings Schema:**
> We are adopting a structured, Spatie-style configuration scheme for global settings. The `Setting` model will group site parameters by `group`, `page`, and `key`, ensuring future pages or modules can be added cleanly without database schema changes.

> [!NOTE]
> **Admin Credentials:**
> The seeder will pre-create:
> * **Email:** `admin@portfolio.test`
> * **Password:** `password`

---

## Proposed Changes

### 1. Database Schema & Models
We need to store settings, tools, projects, experiences, and messages.

#### [NEW] [Setting.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Models/Setting.php)
* A structured config model utilizing `group`, `page`, `key`, and `value` parameters.
* **Migration Schema:**
  * `id`
  * `group` (string, nullable)
  * `page` (string, nullable)
  * `key` (string)
  * `value` (text, nullable)
  * Unique constraint on `['group', 'page', 'key']` to prevent duplicates.
  * Timestamps
* **Seed keys (Group: `hero`, Page: `home`):**
  * `hello` (e.g. "Hello there! 👋 I'm Ebiye")
  * `title` (e.g. "Full-Stack Web Developer")
  * `description` (Bio text)
  * `available` (Boolean status string)

#### [NEW] [Tool.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Models/Tool.php)
* Fields: `id`, `name`, `logo_path`, `order` (integer), `created_at`, `updated_at`.

#### [NEW] [Project.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Models/Project.php)
* Fields: `id`, `title`, `description`, `image_path`, `route_url`, `technologies` (JSON array), `created_at`, `updated_at`.

#### [NEW] [Experience.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Models/Experience.php)
* Fields: `id`, `period`, `role`, `company`, `company_url`, `location`, `description`, `responsibilities` (JSON array), `technologies` (JSON array), `created_at`, `updated_at`.

#### [NEW] [Message.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Models/Message.php)
* Fields: `id`, `name`, `email`, `message`, `created_at`, `updated_at`.

#### [NEW] Database Migrations
* Create migrations for the five tables above.

#### [MODIFY] [DatabaseSeeder.php](file:///c:/Users/EBI/Develop/others/portfolio/database/seeders/DatabaseSeeder.php)
* Seed the structured `settings` table with the homepage Hero copy.
* Seed the `tools` table with your current 10 tools.
* Seed `projects` and `experiences` with your existing welcome page content.
* Create default admin user credentials.

---

### 2. Contact Form Update

#### [MODIFY] [ContactForm.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Livewire/ContactForm.php)
* Save submissions to the `messages` table in addition to triggering standard mail notifications.

---

### 3. Authentication & Security

#### [NEW] [Login.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Livewire/Admin/Login.php) & [login.blade.php](file:///c:/Users/EBI/Develop/others/portfolio/resources/views/livewire/admin/login.blade.php)
* Clean login screen under `/admin/login` using standard Laravel session authentication.

---

### 4. Admin Layout & Routes

#### [NEW] [admin.blade.php](file:///c:/Users/EBI/Develop/others/portfolio/resources/views/components/layouts/admin.blade.php)
* Sidebar/topbar layout following the Ares Design system (Instrument Sans, dark panel `#0d0d0d`, dotted canvas).

#### [MODIFY] [web.php](file:///c:/Users/EBI/Develop/others/portfolio/routes/web.php)
* `/admin/login` (Guest only).
* `/admin` (Protected by `auth` middleware).
* Route `/` callback will retrieve settings (grouped/paginated), tools, projects, and experiences from the database and pass them to the home page view.

---

### 5. Consolidated Livewire CMS Dashboard

#### [NEW] [Dashboard.php](file:///c:/Users/EBI/Develop/others/portfolio/app/Livewire/Admin/Dashboard.php) & [dashboard.blade.php](file:///c:/Users/EBI/Develop/others/portfolio/resources/views/livewire/admin/dashboard.blade.php)
* Primary dashboard wrapper with a layout matching the design guidelines.
* Sidebar Navigation:
  * **Overview:** Summaries of analytics and latest 5 messages.
  * **CMS:** Expands to show the sub-tab views:
    * *Hero Settings:* Form to update bio texts and availability toggle (filtering on group `hero` and page `home`).
    * *Tools Manager:* CRUD grid to add/remove and order tools.
    * *Projects Manager:* CRUD interface for managing projects.
    * *Experience Manager:* CRUD interface for managing experiences.
  * **Messages:** Message management console (mark as read, delete).

---

### 6. Dynamic Main Page Integration

#### [MODIFY] [welcome.blade.php](file:///c:/Users/EBI/Develop/others/portfolio/resources/views/welcome.blade.php)
* Replace all hardcoded texts in the Hero block with references to dynamic `$settings`.
* Loop over database collections for the tools, projects, and experiences cards.

---

## Verification Plan

### Automated Tests
I will write a comprehensive feature test [AdminDashboardTest.php](file:///c:/Users/EBI/Develop/others/portfolio/tests/Feature/AdminDashboardTest.php) to verify:
* Secure access restrictions to `/admin`.
* Proper admin login.
* Contact forms save messages correctly.
* Hero settings update properly in the CMS.
* CRUD operations for projects, tools, and experiences.

Run the test suite:
```bash
php artisan test
```

### Manual Verification
* Log in, click on the **CMS** tab, expand the sub-tabs, and update your Hero text. Refresh the home page and verify the copy changes instantly.
* Upload a new tool logo/SVG and confirm it is styled and rendered correctly in the tools section.
