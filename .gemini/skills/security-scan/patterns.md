# Security Vulnerability Patterns Reference

## Dangerous PHP Functions

### Remote Code Execution (RCE)
```
eval()
assert()
create_function()
preg_replace() with /e modifier
```

### Command Injection
```
exec()
system()
shell_exec()
passthru()
popen()
proc_open()
pcntl_exec()
```

### File Inclusion
```
include()
include_once()
require()
require_once()
fopen()
file_get_contents()
file_put_contents()
readfile()
```

### Information Disclosure
```
phpinfo()
debug_backtrace()
debug_print_backtrace()
var_dump()
print_r()
```

## Laravel-Specific Vulnerabilities

### Unsafe Blade Syntax
```blade
{{-- UNSAFE: Raw output, potential XSS --}}
{!! $userInput !!}
<?php echo $userInput; ?>

{{-- SAFE: Escaped output --}}
{{ $userInput }}
```

### Mass Assignment
```php
// UNSAFE: No fillable/guarded
class Post extends Model {}

// UNSAFE: Empty guarded (allows all)
protected $guarded = [];

// SAFE: Explicit fillable
protected $fillable = ['title', 'content'];
```

### Raw Queries with User Input
```php
// UNSAFE
DB::raw("WHERE status = '$status'")
DB::select("SELECT * FROM users WHERE id = $id")
User::whereRaw("email = '$email'")

// SAFE
DB::raw("WHERE status = ?", [$status])
User::where('email', $email)
```

### Unvalidated Redirects
```php
// UNSAFE
return redirect($request->input('url'));

// SAFE
return redirect()->intended('/dashboard');
```

### File Upload Without Validation
```php
// UNSAFE
$file = $request->file('upload');
$file->store('uploads');

// SAFE
$request->validate([
    'upload' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
]);
$file = $request->file('upload');
$file->store('uploads');
```

## Security Headers Checklist

```php
// Recommended security headers middleware
class SecurityHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');

        if (config('app.env') === 'production') {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
```

## Authentication Security Checklist

- [ ] Password minimum 8 characters with complexity
- [ ] Account lockout after 5 failed attempts
- [ ] Rate limiting on login endpoint (e.g., 5 per minute)
- [ ] Session regeneration after login
- [ ] Secure session configuration
- [ ] CSRF protection on all forms
- [ ] Remember token rotation
- [ ] Password reset token expiration (< 1 hour)

## Session Security Configuration

```php
// config/session.php
'secure' => env('SESSION_SECURE_COOKIE', true), // HTTPS only
'http_only' => true, // No JavaScript access
'same_site' => 'lax', // CSRF protection
'expire_on_close' => false,
'lifetime' => 120, // 2 hours max
```

## CORS Security Configuration

```php
// config/cors.php
'allowed_origins' => ['https://yourdomain.com'], // Not '*' in production
'allowed_methods' => ['GET', 'POST'], // Only what's needed
'allowed_headers' => ['Content-Type', 'Authorization'],
'supports_credentials' => true,
```

## Database Security

### Preventing SQL Injection
```php
// Always use Eloquent or query builder
User::where('email', $email)->first();
DB::table('users')->where('email', $email)->first();

// If raw is needed, use bindings
DB::select('SELECT * FROM users WHERE email = ?', [$email]);
```

### Sensitive Data
```php
// Hide sensitive attributes from serialization
protected $hidden = ['password', 'remember_token', 'api_key'];

// Encrypt sensitive data
protected $casts = [
    'ssn' => 'encrypted',
    'api_secret' => 'encrypted',
];
```

## API Security

### Rate Limiting
```php
// routes/api.php
Route::middleware('throttle:60,1')->group(function () {
    // 60 requests per minute
});

// Custom rate limiter in AppServiceProvider
RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});
```

### Input Validation
```php
// Always validate API input
$validated = $request->validate([
    'email' => ['required', 'email', 'max:255'],
    'password' => ['required', 'string', 'min:8'],
]);
```

## Grep Patterns for Scanning

```bash
# SQL Injection
rg "DB::raw|whereRaw|selectRaw|havingRaw|orderByRaw" --type php
rg "DB::select.*\\\$|DB::statement.*\\\$" --type php

# XSS
rg "\{!!" --type blade
rg "echo\s+\\\$" --type php

# Command Injection
rg "exec\(|system\(|shell_exec\(|passthru\(|popen\(" --type php

# Hardcoded Secrets
rg "(password|secret|api_key|apikey|token)\s*=\s*['\"][^'\"]+['\"]" --type php -i

# Unsafe Functions
rg "eval\(|assert\(|create_function\(" --type php
rg "unserialize\(" --type php

# Debug in Production
rg "dd\(|dump\(|var_dump\(|print_r\(" app/ routes/

# Unsafe File Operations
rg "file_get_contents\(\\\$|fopen\(\\\$|include\s+\\\$|require\s+\\\$" --type php

# Missing CSRF
rg "<form" resources/views/ | grep -v "@csrf"

# Information Disclosure
rg "phpinfo\(" --type php
rg "APP_DEBUG.*true" .env*
```

## JavaScript/Frontend Security

### XSS Prevention
```javascript
// UNSAFE: innerHTML with user data
element.innerHTML = userInput;

// SAFE: textContent for text
element.textContent = userInput;

// SAFE: DOMPurify for HTML
element.innerHTML = DOMPurify.sanitize(userInput);
```

### Sensitive Data in Frontend
```javascript
// Never expose in JavaScript
const apiKey = 'sk-xxx'; // UNSAFE
const userPassword = props.password; // UNSAFE

// Use backend proxy for sensitive operations
```

## NPM Vulnerability Patterns

```bash
# Check for vulnerabilities
npm audit

# Check for outdated packages
npm outdated

# Common vulnerable patterns
- Prototype pollution
- ReDoS (Regular Expression DoS)
- Path traversal in dependencies
```

## Environment Security

### .env Checklist
```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:... # Must be set, 32 chars

SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE_COOKIE=lax

# No default passwords
DB_PASSWORD=<strong-unique-password>
REDIS_PASSWORD=<strong-unique-password>
```

### .gitignore Must Include
```
.env
.env.backup
.env.production
*.pem
*.key
storage/oauth-*.key
```
