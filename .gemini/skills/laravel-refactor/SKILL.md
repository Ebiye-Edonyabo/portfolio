---
name: laravel-refactor
description: Safely refactors Laravel code with proper test coverage and incremental changes. Use when the user wants to refactor, improve, clean up, restructure, or optimize existing Laravel code.
---

# Laravel Refactor

## Overview

Performs safe, incremental refactoring of Laravel applications while maintaining functionality through comprehensive test coverage.

## Instructions

### 1. Before Refactoring

**Always start by:**

1. Understanding the current implementation
2. Identifying existing tests
3. Running existing tests to establish baseline
4. Creating new tests if coverage is insufficient

```bash
php artisan test --compact --filter=RelatedTest
```

### 2. Refactoring Principles

- **Small, incremental changes** - One refactoring at a time
- **Run tests after each change** - Catch breaks immediately
- **Preserve behavior** - Same inputs produce same outputs
- **Improve readability** - Code should be easier to understand
- **No feature changes** - Refactoring is not adding features

### 3. Common Refactoring Patterns

#### Extract Method

Before:
```php
public function store(Request $request)
{
    $validated = $request->validate([...]);

    // 20 lines of complex logic
    $user = User::create([...]);
    event(new UserCreated($user));
    Mail::to($user)->send(new Welcome($user));

    return redirect()->route('users.show', $user);
}
```

After:
```php
public function store(StoreUserRequest $request): RedirectResponse
{
    $user = $this->createUser($request->validated());

    return redirect()->route('users.show', $user);
}

private function createUser(array $data): User
{
    $user = User::create($data);

    event(new UserCreated($user));
    Mail::to($user)->send(new Welcome($user));

    return $user;
}
```

#### Extract to Service Class

Before:
```php
class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Complex order processing logic
        // Payment handling
        // Inventory updates
        // Notification sending
    }
}
```

After:
```php
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
    ) {}

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $order = $this->orderService->create($request->validated());

        return redirect()->route('orders.show', $order);
    }
}
```

#### Extract to Action Class

```php
namespace App\Actions;

class CreateOrder
{
    public function __construct(
        private PaymentGateway $payments,
        private InventoryService $inventory,
    ) {}

    public function execute(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create($data);
            $this->payments->charge($order);
            $this->inventory->reserve($order->items);

            return $order;
        });
    }
}
```

#### Replace Conditional with Polymorphism

Before:
```php
public function calculateDiscount(Order $order): float
{
    if ($order->customer->type === 'premium') {
        return $order->total * 0.20;
    } elseif ($order->customer->type === 'regular') {
        return $order->total * 0.10;
    } else {
        return 0;
    }
}
```

After:
```php
interface DiscountStrategy
{
    public function calculate(Order $order): float;
}

class PremiumDiscount implements DiscountStrategy
{
    public function calculate(Order $order): float
    {
        return $order->total * 0.20;
    }
}

class RegularDiscount implements DiscountStrategy
{
    public function calculate(Order $order): float
    {
        return $order->total * 0.10;
    }
}
```

#### Use Query Scopes

Before:
```php
$activeUsers = User::where('status', 'active')
    ->where('email_verified_at', '!=', null)
    ->where('created_at', '>', now()->subYear())
    ->get();
```

After:
```php
// In User model
public function scopeActive(Builder $query): Builder
{
    return $query->where('status', 'active');
}

public function scopeVerified(Builder $query): Builder
{
    return $query->whereNotNull('email_verified_at');
}

public function scopeRecent(Builder $query): Builder
{
    return $query->where('created_at', '>', now()->subYear());
}

// Usage
$activeUsers = User::active()->verified()->recent()->get();
```

#### Extract Validation to Form Request

Before:
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    // ...
}
```

After:
```php
public function store(StoreUserRequest $request)
{
    $validated = $request->validated();
    // ...
}
```

### 4. Database Query Optimization

#### Eager Loading

```php
// Before: N+1 problem
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->author->name; // Query per post
}

// After: Eager loaded
$posts = Post::with('author')->get();
```

#### Chunking Large Datasets

```php
// Before: Memory issues
User::all()->each(function ($user) {
    // Process user
});

// After: Chunked processing
User::query()->chunk(100, function ($users) {
    foreach ($users as $user) {
        // Process user
    }
});
```

### 5. Testing During Refactor

Write characterization tests before refactoring:

```php
it('processes order correctly', function () {
    // Capture current behavior
    $order = Order::factory()->create(['total' => 100]);
    $customer = Customer::factory()->premium()->create();
    $order->customer()->associate($customer);

    $discount = calculateDiscount($order);

    expect($discount)->toBe(20.0);
});
```

### 6. Refactoring Workflow

1. **Read** - Understand the code thoroughly
2. **Test** - Ensure tests exist and pass
3. **Refactor** - Make one small change
4. **Test** - Run tests to verify behavior
5. **Commit** - Save progress with descriptive message
6. **Repeat** - Continue with next refactoring

## Checklist

- [ ] Existing tests pass before starting
- [ ] New tests added for uncovered code
- [ ] One refactoring applied at a time
- [ ] Tests run after each change
- [ ] No behavior changes introduced
- [ ] Code formatted with Pint
- [ ] Changes committed incrementally
