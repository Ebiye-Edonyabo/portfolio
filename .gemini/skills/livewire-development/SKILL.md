---
name: livewire-development
description: "Apply this skill whenever writing, reviewing, or testing Livewire components. This includes creating or modifying frontend interfaces using Livewire 3 features, data binding, events, actions, lifecycle hooks, file uploads, Alpine.js integrations, wire:loading, wire:model, and Livewire component testing. Covers any frontend Livewire template or backend Livewire class changes."
---

# Livewire 3 Development Guidelines

Use this skill as the technical framework for creating, modifying, and testing Livewire components in the application.

---

## 1. Foundational Rules

* **Single Root Element:** Every Blade template of a Livewire component **must** wrap its entire markup inside a single, unified root HTML element (e.g. `<div>`).
* **Livewire 3 Namespace:** Component class files must reside under `App\Livewire` (not `App\Http\Livewire`).
* **Pint Formatting:** Run `vendor/bin/pint --dirty` after modifying any PHP files related to Livewire classes.

---

## 2. Data Binding & State Management

### 2.1 Model Binding
* **Deferred by default:** In Livewire 3, `wire:model` is deferred by default (it only sends the server request when an action button is clicked).
* **Real-time updates:** Use `wire:model.live` or `wire:model.live.debounce.150ms` only when you need real-time validation, search filtering, or reactive changes as the user types.

```html
<!-- REACITVE SEARCH: Debounced real-time updates -->
<input type="search" wire:model.live.debounce.250ms="search" placeholder="Search projects...">
```

### 2.2 Livewire Forms (Form Objects)
For complex data validation (e.g., contact forms, update forms), encapsulate validation rules and properties inside a dedicated Livewire Form Class.

```php
namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;

class ContactForm extends Form
{
    #[Rule('required|min:3')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:10')]
    public string $message = '';
}
```

---

## 3. Events & Lifecycle Actions

### 3.1 Event Dispatching
Always use the Livewire 3 unified event helper `$this->dispatch()` (replaces legacy `emit` and `dispatchBrowserEvent`).

```php
// Server-side trigger
$this->dispatch('project-saved', projectId: $project->id);

// Intercepting at browser level (in Alpine.js)
// <div x-on:project-saved.window="notify($event.detail.projectId)">
```

### 3.2 Key Loop Binding (`wire:key`)
Always supply a unique `wire:key` on elements inside `@foreach` loops to prevent DOM state mismatches when items re-render.

```html
@foreach ($projects as $project)
    <div wire:key="project-card-{{ $project->id }}" class="project-card">
        <h3>{{ $project->title }}</h3>
    </div>
@endforeach
```

---

## 4. UI Indicators (Loading & Dirty States)

### 4.1 Loading States
Implement smooth visual loading indicators for actions. Restrict loaders to specific triggers using `wire:target` to prevent page-wide flickering.

```html
<!-- Disable button and show custom indicator on submit -->
<button type="submit" wire:loading.attr="disabled" class="btn">
    <span wire:loading.remove wire:target="submit">Save Changes</span>
    <span wire:loading wire:target="submit" class="animate-pulse">Saving...</span>
</button>
```

### 4.2 Dirty State
Highlight elements that have unstaged modifications using `wire:dirty`.

```html
<span wire:dirty wire:target="title" class="text-xs text-primary-300">
    (Unsaved Changes)
</span>
```

---

## 5. Alpine.js Integration

Livewire 3 includes Alpine.js by default. Do not import Alpine separately. 

### 5.1 Communication ($wire)
You can directly read or write Livewire properties and call backend methods inside your Alpine scopes using the magic `$wire` property.

```html
<div x-data="{ open: false }" x-on:click.outside="open = false">
    <button x-on:click="open = !open">Toggle Logs</button>

    <div x-show="open" x-cloak>
        <!-- Read property value on client-side -->
        <span x-text="$wire.statusMessage"></span>
        
        <!-- Execute server-side action directly -->
        <button x-on:click="$wire.clearLogs()">Clear</button>
    </div>
</div>
```

---

## 6. Testing Livewire Components

Always write PHPUnit feature tests to verify your component's states, parameters, and action validations.

```php
namespace Tests\Feature;

use App\Livewire\ContactForm;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_can_submit_valid_contact_details(): void
    {
        Livewire::test(ContactForm::class)
            ->set('form.name', 'Ebiye')
            ->set('form.email', 'edonyaboebiye11@gmail.com')
            ->set('form.message', 'Hello! Let\'s build a dashboard.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSee('Thank you for reaching out!');
    }

    public function test_requires_valid_email(): void
    {
        Livewire::test(ContactForm::class)
            ->set('form.email', 'invalid-email')
            ->call('submit')
            ->assertHasErrors(['form.email']);
    }
}
```
