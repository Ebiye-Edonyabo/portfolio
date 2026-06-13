---
name: security-scan
description: Performs comprehensive security vulnerability scanning based on OWASP Top 10, CWE patterns, and security best practices. Use after running tests, or when the user wants to scan, audit, check security, find vulnerabilities, or review code for security issues.
---

# Security Vulnerability Scanner

## Overview

This skill performs comprehensive security analysis of the codebase, checking for OWASP Top 10 vulnerabilities, CWE patterns, and framework-specific security issues.

## When to Run

- After tests pass successfully
- Before deploying to production
- During code review
- When explicitly requested by user

## Scanning Process

### Step 1: Pre-Scan Checks

1. Confirm tests have passed (if running post-test)
2. Identify the technology stack and frameworks in use
3. Determine scope of scan (full codebase or specific files)

### Step 2: OWASP Top 10 Analysis (2021)

Scan for each vulnerability category:

#### A01:2021 - Broken Access Control
- [ ] Check authorization on all routes/endpoints
- [ ] Look for missing `authorize()` calls in controllers
- [ ] Verify Policy usage on models
- [ ] Check for IDOR (Insecure Direct Object References)
- [ ] Look for mass assignment vulnerabilities (`$fillable`/`$guarded`)
- [ ] Verify middleware protection on sensitive routes

```php
// VULNERABLE: No authorization check
public function show($id) {
    return User::find($id); // Anyone can view any user
}

// SECURE: Proper authorization
public function show(User $user) {
    $this->authorize('view', $user);
    return $user;
}
```

#### A02:2021 - Cryptographic Failures
- [ ] Check for sensitive data in logs
- [ ] Verify passwords use `Hash::make()` not md5/sha1
- [ ] Look for hardcoded secrets/API keys
- [ ] Check .env files are not committed
- [ ] Verify HTTPS enforcement in production
- [ ] Check encryption of sensitive database fields

#### A03:2021 - Injection
- [ ] SQL Injection via raw queries
- [ ] Command injection via `exec()`, `shell_exec()`, `system()`
- [ ] LDAP injection
- [ ] XPath injection
- [ ] NoSQL injection

```php
// VULNERABLE: SQL Injection
DB::select("SELECT * FROM users WHERE email = '$email'");

// SECURE: Parameterized query
DB::select("SELECT * FROM users WHERE email = ?", [$email]);
User::where('email', $email)->first();
```

#### A04:2021 - Insecure Design
- [ ] Missing rate limiting on sensitive endpoints
- [ ] No account lockout after failed attempts
- [ ] Missing CAPTCHA on public forms
- [ ] Insufficient logging of security events

#### A05:2021 - Security Misconfiguration
- [ ] Debug mode enabled in production (`APP_DEBUG=true`)
- [ ] Default credentials in use
- [ ] Unnecessary features enabled
- [ ] Missing security headers
- [ ] Exposed error messages with stack traces

#### A06:2021 - Vulnerable Components
- [ ] Check `composer.json` for known vulnerable packages
- [ ] Check `package.json` for vulnerable npm packages
- [ ] Verify dependencies are up to date

#### A07:2021 - Authentication Failures
- [ ] Weak password requirements
- [ ] Missing brute force protection
- [ ] Session fixation vulnerabilities
- [ ] Insecure "remember me" implementation
- [ ] Missing MFA on sensitive operations

#### A08:2021 - Software and Data Integrity Failures
- [ ] Unsigned serialized data
- [ ] Missing integrity checks on uploads
- [ ] Insecure deserialization (`unserialize()` on user input)
- [ ] Missing CI/CD pipeline security

#### A09:2021 - Security Logging and Monitoring Failures
- [ ] Missing audit logs for sensitive operations
- [ ] No alerting on suspicious activity
- [ ] Logs contain sensitive data (passwords, tokens)

#### A10:2021 - Server-Side Request Forgery (SSRF)
- [ ] Unvalidated URL inputs
- [ ] File inclusion vulnerabilities
- [ ] Internal service exposure

### Step 3: CWE Pattern Detection

Check for these Common Weakness Enumerations:

| CWE ID | Name | What to Look For |
|--------|------|------------------|
| CWE-79 | XSS | Unescaped output: `{!! $var !!}`, `echo $input` |
| CWE-89 | SQL Injection | Raw queries with user input |
| CWE-94 | Code Injection | `eval()`, `create_function()` |
| CWE-78 | OS Command Injection | `exec()`, `system()`, `passthru()` |
| CWE-22 | Path Traversal | File operations without path validation |
| CWE-434 | Unrestricted Upload | Missing file type/size validation |
| CWE-352 | CSRF | Forms without `@csrf` token |
| CWE-502 | Deserialization | `unserialize()` on untrusted data |
| CWE-798 | Hardcoded Credentials | Passwords/keys in source code |
| CWE-200 | Information Exposure | Sensitive data in responses/logs |
| CWE-287 | Improper Authentication | Missing/weak auth checks |
| CWE-862 | Missing Authorization | Endpoints without access control |
| CWE-918 | SSRF | User-controlled URLs in requests |
| CWE-611 | XXE | XML parsing without disabling entities |

### Step 4: Laravel-Specific Security Checks

#### Blade Templates
```bash
# Find potential XSS vulnerabilities
grep -r "{!!" resources/views/
grep -r "echo \$" resources/views/
```

#### Mass Assignment
```php
// Check all models have $fillable or $guarded
// VULNERABLE: No protection
class User extends Model {}

// SECURE: Explicit fillable
class User extends Model {
    protected $fillable = ['name', 'email'];
}
```

#### Route Security
```php
// Check sensitive routes have middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // Protected routes
});
```

#### File Uploads
```php
// Verify validation exists
$request->validate([
    'file' => ['required', 'file', 'mimes:pdf,doc', 'max:10240'],
]);
```

### Step 5: Static Analysis Commands

Run these tools if available:

```bash
# PHP Security Checker (Symfony)
composer require --dev enlightn/security-checker
./vendor/bin/security-checker security:check

# PHPStan with security rules
./vendor/bin/phpstan analyse --level=max

# Psalm security analysis
./vendor/bin/psalm --taint-analysis

# NPM audit
npm audit

# Composer audit
composer audit
```

### Step 6: Code Pattern Search

Use Grep to find vulnerable patterns:

```bash
# SQL Injection patterns
grep -rn "DB::raw\|DB::select\|DB::statement" --include="*.php"
grep -rn "whereRaw\|selectRaw\|orderByRaw" --include="*.php"

# Command Injection
grep -rn "exec(\|system(\|shell_exec(\|passthru(\|popen(" --include="*.php"

# XSS patterns
grep -rn "{!!\|@php echo" --include="*.blade.php"

# Hardcoded secrets
grep -rn "password\s*=\s*['\"]" --include="*.php"
grep -rn "api_key\s*=\s*['\"]" --include="*.php"
grep -rn "secret\s*=\s*['\"]" --include="*.php"

# Unsafe deserialization
grep -rn "unserialize(" --include="*.php"

# eval usage
grep -rn "eval(" --include="*.php"

# File inclusion
grep -rn "include\s*\$\|require\s*\$" --include="*.php"

# Debug functions in production code
grep -rn "dd(\|dump(\|var_dump(\|print_r(" --include="*.php" app/ routes/
```

### Step 7: Configuration Review

Check these files:

1. **`.env`** - No sensitive defaults, proper APP_KEY
2. **`config/app.php`** - Debug disabled for production
3. **`config/session.php`** - Secure cookie settings
4. **`config/cors.php`** - Restrictive CORS policy
5. **`bootstrap/app.php`** - Security middleware configured

### Step 8: Report Generation

Generate a security report with:

1. **Critical** - Must fix immediately (SQL injection, RCE, auth bypass)
2. **High** - Fix soon (XSS, CSRF, sensitive data exposure)
3. **Medium** - Should fix (missing rate limiting, weak configs)
4. **Low** - Consider fixing (informational, hardening)

## Output Format

```markdown
# Security Scan Report

## Summary
- Critical: X issues
- High: X issues
- Medium: X issues
- Low: X issues

## Critical Issues

### [CWE-89] SQL Injection in UserController
**File:** app/Http/Controllers/UserController.php:45
**Code:**
\`\`\`php
DB::select("SELECT * FROM users WHERE id = $id");
\`\`\`
**Fix:** Use parameterized queries
\`\`\`php
DB::select("SELECT * FROM users WHERE id = ?", [$id]);
\`\`\`

## High Issues
...

## Recommendations
1. Install and configure security scanning in CI/CD
2. Enable rate limiting on all authentication endpoints
3. Add security headers middleware
```

## Post-Scan Actions

1. Present findings to user with severity levels
2. Offer to fix critical and high issues automatically
3. Suggest security hardening improvements
4. Recommend security testing additions
