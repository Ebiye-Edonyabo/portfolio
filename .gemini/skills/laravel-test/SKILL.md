---
name: laravel-test
description: Writes comprehensive Pest tests including unit tests, feature tests, and browser tests. Use when the user wants to write tests, create tests, add test coverage, test a feature, or implement browser testing.
---

# Laravel Test

## Overview

Creates comprehensive test suites using Pest PHP, covering unit tests, feature tests, and browser tests for Laravel applications.

## Instructions

### 1. Test Types

| Type | Location | Purpose |
|------|----------|---------|
| Unit | `tests/Unit/` | Test isolated classes/methods |
| Feature | `tests/Feature/` | Test HTTP endpoints, workflows |
| Browser | `tests/Browser/` | Test real browser interactions |

### 2. Creating Tests

```bash
# Feature test (default)
php artisan make:test UserManagementTest --pest --no-interaction

# Unit test
php artisan make:test Services/PaymentServiceTest --pest --unit --no-interaction

# Browser test (Pest 4)
php artisan make:test Browser/CheckoutFlowTest --pest --no-interaction
```

### 3. Feature Test Patterns

#### Basic CRUD Testing

```php
use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('index', function () {
    it('displays all posts', function () {
        Post::factory()->count(3)->create();

        $response = $this->actingAs($this->user)
            ->get(route('posts.index'));

        $response->assertSuccessful()
            ->assertInertia(fn ($page) => $page
                ->component('Posts/Index')
                ->has('posts.data', 3)
            );
    });

    it('paginates posts', function () {
        Post::factory()->count(20)->create();

        $response = $this->actingAs($this->user)
            ->get(route('posts.index', ['page' => 2]));

        $response->assertSuccessful();
    });
});

describe('store', function () {
    it('creates a post with valid data', function () {
        $data = [
            'title' => 'Test Post',
            'content' => 'Test content here',
        ];

        $response = $this->actingAs($this->user)
            ->post(route('posts.store'), $data);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', $data);
    });

    it('validates required fields', function () {
        $response = $this->actingAs($this->user)
            ->post(route('posts.store'), []);

        $response->assertSessionHasErrors(['title', 'content']);
    });

    it('rejects invalid data', function (array $data, string $field) {
        $response = $this->actingAs($this->user)
            ->post(route('posts.store'), $data);

        $response->assertSessionHasErrors($field);
    })->with([
        'empty title' => [['title' => '', 'content' => 'Valid'], 'title'],
        'title too long' => [['title' => str_repeat('a', 256), 'content' => 'Valid'], 'title'],
        'empty content' => [['title' => 'Valid', 'content' => ''], 'content'],
    ]);
});

describe('authorization', function () {
    it('requires authentication', function () {
        $response = $this->get(route('posts.index'));

        $response->assertRedirect(route('login'));
    });

    it('prevents unauthorized deletion', function () {
        $post = Post::factory()->create();
        $otherUser = User::factory()->create();

        $response = $this->actingAs($otherUser)
            ->delete(route('posts.destroy', $post));

        $response->assertForbidden();
    });
});
```

#### API Testing

```php
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});

it('returns paginated resources', function () {
    Post::factory()->count(5)->create();

    $response = $this->getJson(route('api.v1.posts.index'));

    $response->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'type', 'attributes'],
            ],
            'links',
            'meta',
        ]);
});

it('creates resource and returns 201', function () {
    $response = $this->postJson(route('api.v1.posts.store'), [
        'title' => 'API Post',
        'content' => 'Content here',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.attributes.title', 'API Post');
});

it('returns 422 for validation errors', function () {
    $response = $this->postJson(route('api.v1.posts.store'), []);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['title']);
});
```

### 4. Unit Test Patterns

```php
use App\Services\PricingService;
use App\Models\Product;

describe('PricingService', function () {
    beforeEach(function () {
        $this->service = new PricingService();
    });

    it('calculates base price correctly', function () {
        $product = Product::factory()->make(['price' => 100]);

        $result = $this->service->calculate($product);

        expect($result)->toBe(100.0);
    });

    it('applies discount for premium customers', function () {
        $product = Product::factory()->make(['price' => 100]);
        $customer = Customer::factory()->premium()->make();

        $result = $this->service->calculate($product, $customer);

        expect($result)->toBe(80.0); // 20% discount
    });

    it('throws exception for negative prices', function () {
        $product = Product::factory()->make(['price' => -10]);

        expect(fn () => $this->service->calculate($product))
            ->toThrow(InvalidArgumentException::class);
    });
});
```

### 5. Browser Testing (Pest 4)

```php
use App\Models\User;
use App\Models\Post;

it('allows user to create a post', function () {
    $user = User::factory()->create();

    $page = visit('/login')
        ->assertSee('Sign In')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('Sign In')
        ->assertPathIs('/dashboard');

    $page->visit('/posts/create')
        ->assertSee('Create Post')
        ->fill('title', 'My New Post')
        ->fill('content', 'This is the content of my post.')
        ->click('Create')
        ->assertSee('Post created successfully')
        ->assertPathIs('/posts');

    $this->assertDatabaseHas('posts', [
        'title' => 'My New Post',
        'user_id' => $user->id,
    ]);
});

it('shows validation errors inline', function () {
    $user = User::factory()->create();

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password')
        ->click('Sign In');

    visit('/posts/create')
        ->click('Create')
        ->assertSee('The title field is required')
        ->assertNoJavascriptErrors();
});

it('works on mobile viewport', function () {
    visit('/')
        ->resize(375, 812) // iPhone X
        ->assertSee('Menu')
        ->click('Menu')
        ->assertSee('Navigation');
});

it('supports dark mode', function () {
    visit('/')
        ->setColorScheme('dark')
        ->screenshot('homepage-dark');
});
```

### 6. Testing Best Practices

#### Use Factories Effectively

```php
// With specific state
$user = User::factory()->admin()->create();

// With relationships
$post = Post::factory()
    ->for(User::factory()->admin())
    ->has(Comment::factory()->count(3))
    ->create();

// Override attributes
$user = User::factory()->create([
    'email' => 'specific@example.com',
]);
```

#### Use Datasets for Similar Tests

```php
it('validates email format', function (string $email) {
    $response = $this->post('/register', [
        'name' => 'Test',
        'email' => $email,
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
})->with([
    'missing @' => ['invalid-email'],
    'missing domain' => ['test@'],
    'spaces' => ['test @example.com'],
]);
```

#### Use Mocking When Appropriate

```php
use function Pest\Laravel\mock;

it('sends notification on order completion', function () {
    $mock = mock(NotificationService::class);
    $mock->shouldReceive('send')
        ->once()
        ->with(Mockery::type(Order::class));

    $order = Order::factory()->create();

    app(OrderService::class)->complete($order);
});
```

### 7. Running Tests

```bash
# All tests
php artisan test --compact

# Specific file
php artisan test --compact tests/Feature/PostTest.php

# Filter by name
php artisan test --compact --filter="creates a post"

# With coverage
php artisan test --coverage

# Parallel execution
php artisan test --parallel
```

### 8. Test Structure

```php
<?php

use App\Models\User;
use App\Models\Post;

beforeEach(function () {
    // Runs before each test
    $this->user = User::factory()->create();
});

afterEach(function () {
    // Cleanup after each test if needed
});

describe('feature group', function () {
    it('does something', function () {
        // Test code
    });

    it('does something else', function () {
        // Test code
    });
});
```

## Testing Checklist

- [ ] Happy path tested
- [ ] Validation errors tested
- [ ] Authorization tested
- [ ] Edge cases covered
- [ ] Database assertions verify state
- [ ] HTTP status codes checked
- [ ] Tests are isolated and independent
- [ ] Factories used for data creation
- [ ] Tests run successfully
