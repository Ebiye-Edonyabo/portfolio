---
name: laravel-debug
description: Debugs Laravel applications using logs, tinker, database queries, and error analysis. Use when the user wants to debug, troubleshoot, fix an error, investigate a bug, or understand why something is not working.
---

# Laravel Debug

## Overview

Systematically debugs Laravel applications using available tools to identify and resolve issues.

## Instructions

### 1. Gather Information

Start by collecting error context:

**Check the last error:**
```
Use the `last-error` MCP tool to see the most recent exception
```

**Read application logs:**
```
Use the `read-log-entries` MCP tool with entries: 20
```

**Check browser console (for frontend issues):**
```
Use the `browser-logs` MCP tool with entries: 10
```

### 2. Common Error Categories

#### HTTP Errors

| Code | Meaning | Common Causes |
|------|---------|---------------|
| 404 | Not Found | Missing route, wrong URL, soft-deleted model |
| 403 | Forbidden | Policy/Gate denial, missing permissions |
| 419 | Page Expired | CSRF token mismatch, session expired |
| 422 | Unprocessable | Validation errors |
| 500 | Server Error | Exception thrown, syntax error |

#### Database Errors

```php
// Use tinker to investigate
User::find(1); // Check if record exists
User::where('email', 'test@example.com')->toSql(); // See generated SQL
```

### 3. Debugging Tools

#### Using Tinker (MCP Tool)

Execute PHP in application context:

```php
// Check model exists
App\Models\User::find(1);

// Test relationship
App\Models\User::find(1)->posts;

// Check config value
config('app.name');

// Test a method
app(App\Services\PaymentService::class)->getGateway();
```

#### Using Database Query (MCP Tool)

Run read-only SQL queries:

```sql
-- Check table structure
DESCRIBE users;

-- Find specific records
SELECT * FROM users WHERE email = 'test@example.com';

-- Check for orphaned records
SELECT * FROM posts WHERE user_id NOT IN (SELECT id FROM users);
```

#### Using Database Schema (MCP Tool)

View full schema structure including:
- Column types and constraints
- Indexes
- Foreign keys
- Table relationships

### 4. Debugging Strategies

#### Route Issues

```php
// In tinker, check if route exists
app('router')->getRoutes()->getByName('users.show');

// List all routes matching pattern
// Use list-routes MCP tool with path filter
```

#### Query Debugging

```php
// Enable query logging
DB::enableQueryLog();

// Run your code
User::with('posts')->find(1);

// See executed queries
DB::getQueryLog();
```

#### Request/Response Debugging

```php
// In controller, dump request data
dd($request->all());

// Check specific input
logger('Input value', ['value' => $request->input('field')]);

// Log to file
Log::info('Debug message', ['context' => $data]);
```

#### Authentication Issues

```php
// In tinker
auth()->check(); // Is user authenticated?
auth()->user(); // Current user
auth()->id(); // Current user ID

// Check session
session()->all();
```

### 5. Error Investigation Flow

```
1. Reproduce the error
   └── Document exact steps to trigger

2. Check logs
   ├── Application logs (read-log-entries)
   ├── Browser logs (browser-logs)
   └── Last error (last-error)

3. Identify error type
   ├── Syntax error → Check file for typos
   ├── Class not found → Run composer dump-autoload
   ├── Method not found → Check method name/visibility
   ├── Query error → Check SQL syntax, table exists
   └── Validation error → Check rules and input

4. Isolate the cause
   ├── Use tinker to test components
   ├── Add logging statements
   └── Check related configurations

5. Fix and verify
   ├── Apply the fix
   ├── Clear caches if needed
   └── Test the fix works
```

### 6. Cache Clearing Commands

When things seem inexplicably broken:

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or all at once
php artisan optimize:clear

# Regenerate autoload
composer dump-autoload
```

### 7. Common Issues and Solutions

#### "Class not found"
```bash
composer dump-autoload
```

#### "View not found"
```bash
php artisan view:clear
# Check view file exists at correct path
```

#### "Route not found"
```bash
php artisan route:clear
php artisan route:list --name=route.name
```

#### "Configuration not updating"
```bash
php artisan config:clear
# Ensure env() is only used in config files
```

#### "CSRF token mismatch"
- Check `@csrf` directive in forms
- Verify session is working
- Check domain/cookie settings

#### "Vite manifest not found"
```bash
npm run build
# Or start dev server: npm run dev
```

### 8. Logging for Debug

Add strategic logging:

```php
use Illuminate\Support\Facades\Log;

// Info level
Log::info('Processing order', ['order_id' => $order->id]);

// Debug level (more verbose)
Log::debug('Order items', ['items' => $order->items->toArray()]);

// Error level
Log::error('Payment failed', [
    'order_id' => $order->id,
    'error' => $exception->getMessage(),
]);
```

## Debugging Checklist

- [ ] Error message captured
- [ ] Stack trace analyzed
- [ ] Logs reviewed
- [ ] Reproduction steps documented
- [ ] Related code examined
- [ ] Fix applied
- [ ] Fix verified working
- [ ] Caches cleared if needed
