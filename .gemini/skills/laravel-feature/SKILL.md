---
name: laravel-feature
description: Implements new Laravel features with complete structure including controller, model, migration, form request, factory, seeder, and tests. Use when the user wants to add, build, create, or implement a new feature, resource, or CRUD functionality.
---

# Laravel Feature Builder

## Overview

Creates complete Laravel feature implementations following best practices and project conventions.

## Instructions

When implementing a new feature:

### 1. Gather Requirements

- Clarify the feature scope and requirements
- Identify relationships with existing models
- Determine validation rules needed
- Check existing patterns in the codebase

### 2. Generate Files Using Artisan

Use `php artisan make:model` with appropriate flags:

```bash
php artisan make:model ModelName -mfsc --no-interaction
```

Flags:
- `-m` - Create migration
- `-f` - Create factory
- `-s` - Create seeder
- `-c` - Create controller

For resource controllers:
```bash
php artisan make:controller ModelNameController --resource --model=ModelName --no-interaction
```

### 3. Create Form Requests

```bash
php artisan make:request StoreModelNameRequest --no-interaction
php artisan make:request UpdateModelNameRequest --no-interaction
```

### 4. Implementation Order

1. **Migration** - Define database schema with proper types and indexes
2. **Model** - Add fillable, casts, relationships, and scopes
3. **Factory** - Create realistic fake data using Faker
4. **Seeder** - Seed development data
5. **Form Requests** - Define validation rules and messages
6. **Controller** - Implement CRUD actions with proper authorization
7. **Routes** - Register routes in appropriate file
8. **Views/Pages** - Create Inertia pages if frontend needed
9. **Tests** - Write comprehensive feature tests

### 5. Model Setup

```php
class ModelName extends Model
{
    protected $fillable = [
        'field_one',
        'field_two',
    ];

    protected function casts(): array
    {
        return [
            'date_field' => 'datetime',
            'json_field' => 'array',
        ];
    }

    public function relatedModel(): BelongsTo
    {
        return $this->belongsTo(RelatedModel::class);
    }
}
```

### 6. Controller Structure

```php
class ModelNameController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('ModelNames/Index', [
            'items' => ModelName::query()
                ->with('relationship')
                ->latest()
                ->paginate(),
        ]);
    }

    public function store(StoreModelNameRequest $request): RedirectResponse
    {
        ModelName::create($request->validated());

        return redirect()->route('model-names.index');
    }
}
```

### 7. Actions and Queries

Use Actions and Queries only when logic cannot be readily understood as user story steps.

#### When to Use Actions

Extract to an Action when:
- **Multiple sequential steps** are required to complete an operation
- **Business logic** cannot be understood at a glance
- **The same operation** is needed in multiple places

Do NOT create an Action for:
- Single-line operations (e.g., `Model::create()`)
- Simple delegations to a service

```php
// Good: Multi-step operation
class StreamChatMessageAction
{
    public function validateInput(string $content): array { /* Step 1 */ }
    public function prepareStream(Conversation $conv, string $content): array { /* Step 2 */ }
    public function streamResponse(Conversation $conv, array $history): \Generator { /* Step 3 */ }
    public function finalizeStream(Conversation $conv): array { /* Step 4 */ }
}

// Bad: Thin wrapper - just call the service directly
class SendMessageAction
{
    public function execute(Conversation $conv, string $content): Message
    {
        return $this->service->sendMessage($conv, $content); // Just a wrapper!
    }
}
```

#### When to Use Queries

Extract to a Query when:
- **Query logic is complex** (10+ lines, multiple joins, aggregations)
- **The same query** is used in multiple places

Do NOT create a Query for:
- Simple Eloquent chains under ~10 lines
- One-time queries in a single location

```php
// Good: Complex, reusable query
class StaffRetirementQuery
{
    public function retiringWithin(int $months): Collection
    {
        return Staff::query()
            ->where('status', 'active')
            ->where(function ($query) use ($months) {
                // Complex retirement date logic...
            })
            ->with(['mda', 'cadre', 'gradeLevel'])
            ->orderBy('expected_retirement_date')
            ->get()
            ->map(fn (Staff $staff) => [/* transformation */]);
    }
}

// Bad: Simple query - keep inline
class ConversationsQuery
{
    public function getForUser(int $userId): Collection
    {
        return Conversation::forUser($userId)->active()->get(); // Too simple!
    }
}
```

#### Decision Flow

```
Is it a database query?
├── Yes → Complex (10+ lines) or reused? → Yes → Query class
│                                        → No  → Inline or Model scope
└── No  → Multi-step business logic? → Yes → Action class
                                     → No  → Keep in controller
```

#### File Organization

```
app/
├── Actions/{Module}/{ActionName}Action.php
├── Queries/{Module}/{QueryName}Query.php
└── Services/{Module}/{ServiceName}Service.php
```

### 8. Form Request Pattern

```php
class StoreModelNameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Or implement authorization logic
    }

    public function rules(): array
    {
        return [
            'field_one' => ['required', 'string', 'max:255'],
            'field_two' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'field_one.required' => 'The field one is required.',
        ];
    }
}
```

### 9. Testing Requirements

Create feature tests covering:
- Index listing with pagination
- Show individual records
- Store with valid data
- Store with invalid data (validation)
- Update existing records
- Delete records
- Authorization (if applicable)

```php
it('can list all model names', function () {
    ModelName::factory()->count(3)->create();

    $response = $this->get(route('model-names.index'));

    $response->assertSuccessful();
});

it('can store a new model name', function () {
    $data = [
        'field_one' => 'Test Value',
        'field_two' => 42,
    ];

    $response = $this->post(route('model-names.store'), $data);

    $response->assertRedirect(route('model-names.index'));
    $this->assertDatabaseHas('model_names', $data);
});
```

## Checklist

- [ ] Migration created with proper schema
- [ ] Model has fillable, casts, and relationships
- [ ] Factory generates realistic data
- [ ] Form requests handle validation
- [ ] Controller follows RESTful conventions
- [ ] Routes registered appropriately
- [ ] Feature tests cover all scenarios
- [ ] Code formatted with Pint
