# Code Health Patterns Reference

## Performance Anti-Patterns

### N+1 Query Detection

```php
// ANTI-PATTERN: N+1 in loop
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->author->name;      // Query per post
    echo $post->comments->count(); // Query per post
}

// SOLUTION: Eager load relationships
$posts = Post::with(['author', 'comments'])->get();

// SOLUTION: With counts
$posts = Post::withCount('comments')->with('author')->get();
```

### Missing Indexes

```php
// Frequently queried columns need indexes
Schema::table('posts', function (Blueprint $table) {
    $table->index('status');           // Filter queries
    $table->index('published_at');     // Order queries
    $table->index(['user_id', 'status']); // Composite for common combo
});
```

### Inefficient Queries

```php
// ANTI-PATTERN: Get all then filter in PHP
$activeUsers = User::all()->filter(fn($u) => $u->is_active);

// SOLUTION: Filter in database
$activeUsers = User::where('is_active', true)->get();

// ANTI-PATTERN: Count via collection
$count = User::all()->count();

// SOLUTION: Database count
$count = User::count();

// ANTI-PATTERN: Check existence by getting all
if (User::where('email', $email)->get()->isNotEmpty()) { }

// SOLUTION: Exists check
if (User::where('email', $email)->exists()) { }
```

### Missing Pagination

```php
// ANTI-PATTERN: Load everything
$posts = Post::all(); // Could be 100,000 records

// SOLUTION: Paginate
$posts = Post::paginate(15);

// SOLUTION: Cursor pagination for large datasets
$posts = Post::cursorPaginate(15);

// SOLUTION: Chunking for background processing
Post::chunk(100, function ($posts) {
    foreach ($posts as $post) {
        // Process
    }
});
```

### Caching Patterns

```php
// Cache expensive queries
$stats = Cache::remember('dashboard.stats', 3600, function () {
    return [
        'users' => User::count(),
        'posts' => Post::count(),
        'revenue' => Order::sum('total'),
    ];
});

// Cache with tags for invalidation
$user = Cache::tags(['users'])->remember("user.{$id}", 3600, fn() =>
    User::with('profile')->find($id)
);

// Invalidate when user updates
Cache::tags(['users'])->flush();

// Cache config and routes in production
// php artisan config:cache
// php artisan route:cache
// php artisan view:cache
```

## Technical Debt Patterns

### Code Smell Indicators

```bash
# Find TODO/FIXME comments
rg "TODO|FIXME|HACK|XXX|TEMP|REFACTOR" --type php -n

# Find @deprecated tags
rg "@deprecated" --type php -n

# Find commented-out code blocks
rg "^\s*//.*function|^\s*//.*class|^\s*/\*" --type php

# Find empty catch blocks
rg "catch.*\{[\s\n]*\}" --type php -U

# Find suppressed errors
rg "@|error_reporting\(0\)" --type php
```

### Complexity Indicators

```bash
# Large files (potential god classes)
find app -name "*.php" -exec wc -l {} + | sort -rn | head -20

# Files with many methods
for f in app/**/*.php; do
    count=$(grep -c "function " "$f" 2>/dev/null)
    if [ "$count" -gt 15 ]; then
        echo "$f: $count methods"
    fi
done

# Deep nesting (complexity)
rg "if.*if.*if" --type php
```

### Naming Inconsistencies

```bash
# Mixed case in same context
rg "function get[A-Z]" --type php  # camelCase
rg "function get_[a-z]" --type php # snake_case

# Inconsistent model naming
ls app/Models/

# Inconsistent controller naming
ls app/Http/Controllers/
```

## Architecture Patterns

### Controller Responsibilities

```php
// ANTI-PATTERN: Fat controller
class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validation (OK)
        $validated = $request->validate([...]);

        // Business logic (MOVE TO SERVICE)
        $discount = $this->calculateDiscount($validated);
        $tax = $this->calculateTax($validated);
        $total = $this->calculateTotal($validated, $discount, $tax);

        // External API call (MOVE TO SERVICE)
        $payment = Stripe::charge($total);

        // Database operations (OK but could be service)
        $order = Order::create([...]);

        // Email sending (QUEUE IT)
        Mail::send(new OrderConfirmation($order));

        return redirect()->route('orders.show', $order);
    }
}

// SOLUTION: Thin controller with service
class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, OrderService $service)
    {
        $order = $service->createOrder($request->validated());

        return redirect()->route('orders.show', $order);
    }
}
```

### Service Layer Pattern

```php
// app/Services/OrderService.php
class OrderService
{
    public function __construct(
        private PaymentGateway $payments,
        private TaxCalculator $tax,
    ) {}

    public function createOrder(array $data): Order
    {
        $pricing = $this->calculatePricing($data);

        $order = DB::transaction(function () use ($data, $pricing) {
            $order = Order::create([
                'total' => $pricing['total'],
                'tax' => $pricing['tax'],
            ]);

            $this->payments->charge($order);

            return $order;
        });

        OrderCreated::dispatch($order); // Event for email, etc.

        return $order;
    }
}
```

### Action Classes Pattern

```php
// app/Actions/CreateOrder.php
class CreateOrder
{
    public function __construct(
        private CalculateOrderTotal $calculateTotal,
        private ChargePayment $chargePayment,
    ) {}

    public function execute(array $data): Order
    {
        $total = $this->calculateTotal->execute($data);

        $order = Order::create([
            'total' => $total,
            ...$data,
        ]);

        $this->chargePayment->execute($order);

        return $order;
    }
}
```

### Repository Pattern (When Needed)

```php
// Use when you need to swap data sources or complex queries
interface UserRepositoryInterface
{
    public function findActive(): Collection;
    public function findByEmail(string $email): ?User;
}

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findActive(): Collection
    {
        return User::where('is_active', true)
            ->with('profile')
            ->orderBy('name')
            ->get();
    }
}

// Usually YAGNI - Eloquent is already a repository
// Only add when you have a concrete need
```

## Dependency Patterns

### Composer Best Practices

```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^11.0"
    },
    "require-dev": {
        "pestphp/pest": "^3.0",
        "laravel/pint": "^1.0"
    },
    "config": {
        "sort-packages": true,
        "optimize-autoloader": true
    }
}
```

### Version Constraint Guide

| Constraint | Meaning | Risk Level |
|------------|---------|------------|
| `*` | Any version | DANGEROUS |
| `>=1.0` | 1.0 or higher | HIGH |
| `^1.2.3` | >=1.2.3 <2.0.0 | LOW (recommended) |
| `~1.2.3` | >=1.2.3 <1.3.0 | LOWEST |
| `1.2.3` | Exactly 1.2.3 | NONE (but no updates) |

### Signs of Abandoned Packages

- No commits in 2+ years
- Open issues with no responses
- No compatibility with current PHP/Laravel
- Archived repository
- Multiple forks more active than original

## Quality Metric Thresholds

| Metric | Good | Warning | Critical |
|--------|------|---------|----------|
| File size | < 200 lines | 200-400 lines | > 400 lines |
| Method size | < 20 lines | 20-40 lines | > 40 lines |
| Methods per class | < 10 | 10-20 | > 20 |
| Cyclomatic complexity | < 5 | 5-10 | > 10 |
| Test coverage | > 80% | 50-80% | < 50% |
| Outdated deps | 0-2 | 3-5 | > 5 |

## Quick Health Check Commands

```bash
# Overall project stats
echo "=== Project Stats ===" && \
echo "PHP Files: $(find app -name '*.php' | wc -l)" && \
echo "Test Files: $(find tests -name '*.php' | wc -l)" && \
echo "Migrations: $(find database/migrations -name '*.php' | wc -l)" && \
echo "Routes: $(php artisan route:list --compact | wc -l)"

# Code quality quick check
echo "=== Quality Indicators ===" && \
echo "TODOs: $(rg -c 'TODO|FIXME' --type php | awk -F: '{sum+=$2} END {print sum}')" && \
echo "dd() calls: $(rg -c 'dd\(' app/ routes/ | awk -F: '{sum+=$2} END {print sum}')" && \
echo "env() in code: $(rg -c 'env\(' app/ --type php | awk -F: '{sum+=$2} END {print sum}')"

# Dependency health
echo "=== Dependencies ===" && \
composer outdated --direct 2>/dev/null | head -10 && \
npm outdated 2>/dev/null | head -10
```
