---
name: laravel-api
description: Builds RESTful API endpoints with Eloquent Resources, proper versioning, authentication, and rate limiting. Use when the user wants to create, build, or implement an API, endpoint, REST API, or JSON response.
---

# Laravel API Builder

## Overview

Creates production-ready API endpoints following Laravel best practices with proper structure, versioning, and security.

## Instructions

### 1. API Structure

Organize API controllers and resources:

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── V1/
│   │           └── ModelNameController.php
│   └── Resources/
│       └── V1/
│           ├── ModelNameResource.php
│           └── ModelNameCollection.php
```

### 2. Create API Controller

```bash
php artisan make:controller Api/V1/ModelNameController --api --model=ModelName --no-interaction
```

### 3. Create API Resources

```bash
php artisan make:resource V1/ModelNameResource --no-interaction
php artisan make:resource V1/ModelNameCollection --collection --no-interaction
```

### 4. API Controller Pattern

```php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModelNameRequest;
use App\Http\Requests\UpdateModelNameRequest;
use App\Http\Resources\V1\ModelNameResource;
use App\Http\Resources\V1\ModelNameCollection;
use App\Models\ModelName;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModelNameController extends Controller
{
    public function index(Request $request): ModelNameCollection
    {
        $items = ModelName::query()
            ->with('relationship')
            ->when($request->query('search'), fn ($q, $search) =>
                $q->where('name', 'like', "%{$search}%")
            )
            ->latest()
            ->paginate($request->query('per_page', 15));

        return new ModelNameCollection($items);
    }

    public function store(StoreModelNameRequest $request): JsonResponse
    {
        $item = ModelName::create($request->validated());

        return (new ModelNameResource($item))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ModelName $modelName): ModelNameResource
    {
        return new ModelNameResource($modelName->load('relationship'));
    }

    public function update(UpdateModelNameRequest $request, ModelName $modelName): ModelNameResource
    {
        $modelName->update($request->validated());

        return new ModelNameResource($modelName);
    }

    public function destroy(ModelName $modelName): JsonResponse
    {
        $modelName->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
```

### 5. API Resource Pattern

```php
namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelNameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'model_names',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'created_at' => $this->created_at->toIso8601String(),
                'updated_at' => $this->updated_at->toIso8601String(),
            ],
            'relationships' => [
                'related' => new RelatedResource($this->whenLoaded('related')),
            ],
            'links' => [
                'self' => route('api.v1.model-names.show', $this->id),
            ],
        ];
    }
}
```

### 6. API Routes

In `routes/api.php`:

```php
use App\Http\Controllers\Api\V1\ModelNameController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('model-names', ModelNameController::class);
    });
});
```

### 7. Rate Limiting

Configure in `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    ]);
})
```

Define rate limiter in `AppServiceProvider`:

```php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

public function boot(): void
{
    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    });
}
```

### 8. API Testing

```php
use App\Models\ModelName;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('lists all model names', function () {
    ModelName::factory()->count(3)->create();

    $response = $this->actingAs($this->user)
        ->getJson(route('api.v1.model-names.index'));

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'type', 'attributes', 'links'],
            ],
            'links',
            'meta',
        ]);
});

it('creates a model name', function () {
    $data = ['name' => 'Test Item'];

    $response = $this->actingAs($this->user)
        ->postJson(route('api.v1.model-names.store'), $data);

    $response->assertCreated()
        ->assertJsonPath('data.attributes.name', 'Test Item');
});

it('returns 401 for unauthenticated requests', function () {
    $response = $this->getJson(route('api.v1.model-names.index'));

    $response->assertUnauthorized();
});

it('validates required fields', function () {
    $response = $this->actingAs($this->user)
        ->postJson(route('api.v1.model-names.store'), []);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['name']);
});
```

### 9. API Response Codes

| Action | Success Code | Error Codes |
|--------|--------------|-------------|
| GET /items | 200 OK | 401, 403, 404 |
| POST /items | 201 Created | 401, 403, 422 |
| PUT /items/{id} | 200 OK | 401, 403, 404, 422 |
| DELETE /items/{id} | 204 No Content | 401, 403, 404 |

## Checklist

- [ ] Controller in versioned namespace (Api/V1)
- [ ] API Resources created for responses
- [ ] Routes registered with proper prefixes
- [ ] Authentication middleware applied
- [ ] Rate limiting configured
- [ ] Proper HTTP status codes used
- [ ] API tests cover all endpoints
- [ ] Error responses follow consistent format
