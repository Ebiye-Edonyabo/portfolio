# Consolidated Implementation Plan - Portfolio CMS

This plan details the design, database schema, and step-by-step changes that converted Ebiye's portfolio landing page into a dynamic Content Management System (CMS) managed via a secure admin dashboard.

---

## Technical Architecture

### 1. Database Schema & Models
We store settings, tools, projects, experiences, and messages in a SQLite database:
* **Setting:** Key-value group configuration structure for page contents.
* **Tool:** Catalog for programming languages and frameworks.
* **Project:** Managed items displayed on the homepage projects section.
* **Experience:** Workplace role timeline details.
* **Message:** Contacts submissions logs.

### 2. Route-Driven Layout
Instead of dynamic component state tab-switching, all dashboard sub-panels have dedicated URLs protected by authentication middleware:
* `/admin` -> Dashboard Overview
* `/admin/hero` -> Hero Intro Editor
* `/admin/tools` -> Tools Grid Manager
* `/admin/projects` -> Projects List Manager
* `/admin/experiences` -> Experience Timeline Manager
* `/admin/messages` -> Messages Inquiry Logs
* `/admin/logout` -> Invokable POST Logout Handler Action

### 3. Client-Side Submenu Toggle
The CMS Manager dropdown navigation in the sidebar utilizes client-side Alpine.js toggle states (`x-data`, `@click`, `x-show`) to eliminate unnecessary Livewire server round-trips.

### 4. Livewire Form Objects
CMS forms encapsulate their properties, validation attributes (`#[Validate]`), loading, and saving actions inside dedicated Form classes (`app/Livewire/Admin/Forms/`) to separate orchestration from field concerns.

---

## Phases & Tasks Roadmap

### Phase 1: Database Schema & Models
* Add migrations and models for Settings, Tools, Projects, Experiences, and Messages.
* Create DatabaseSeeder to seed dynamic contents.

### Phase 2: Contact Form Integration
* Update homepage `ContactForm` to save inquiries directly to the messages database table.

### Phase 3: Admin Authentication
* Implement the Livewire `Login` page component and blade views under `/admin/login`.

### Phase 4: Admin Layout & Routing
* Create the base Neon-Dark layout frame `components.layouts.admin`.

### Phase 5: Livewire CMS Panels
* Create all component panels (Dashboard, Hero, Tools, Projects, Experiences, Messages) and their views.

### Phase 6: HomePage Dynamic Integration
* Refactor homepage `welcome.blade.php` to fetch values dynamically from database models.

### Phase 7: Verification & Testing
* Create `AdminDashboardTest.php` feature tests verifying auth locks and CRUD logic.

### Phase 8: Overview Refactoring & Alpine Sidebar Toggle
* Consolidate Overview component layouts directly inside parent Dashboard view.
* Remove redundant sub-component files.
* Replace sidebar CMS menu toggle with client-side Alpine.js toggle.

### Phase 9: Route-Driven Navigation & Shared Sidebar
* Create shared `<x-admin.sidebar>` component mapping standard href links.
* Update web routes to declare separate panel paths and invite invokable `LogoutAction`.
* Register `#[Layout]` titles on component classes.

### Phase 10: Livewire Form Objects Refactoring
* Create Form Objects `HeroForm`, `ToolForm`, `ProjectForm`, and `ExperienceForm` to manage fields and validations.
* Clean up Livewire components and bind views using dot notation.

### Phase 11: Forms Folder Relocation
* Move Forms folder inside the Admin subdirectory (`app/Livewire/Admin/Forms`).
* Update namespaces and imports.
