---
name: code-health
description: Performs comprehensive codebase health review including performance analysis, tech debt identification, architecture conformance, and dependency auditing. Use when the user wants to review, audit, analyze, or assess the codebase health, quality, or overall state of the project.
---

# Codebase Health Review

## Overview

This skill performs a thorough health check of the entire codebase, identifying performance issues, technical debt, architectural problems, and dependency concerns.

## When to Use

- Project onboarding / understanding a new codebase
- Periodic health checks (monthly/quarterly)
- Pre-release audits
- Before major refactoring efforts
- When inheriting legacy code

## Review Process

### Phase 1: Project Overview

1. **Identify Stack & Structure**
   - Read `composer.json` and `package.json` for dependencies
   - Check Laravel version and installed packages
   - Map directory structure and conventions used

2. **Understand Architecture**
   - Identify patterns in use (Repository, Service, Action classes)
   - Check for domain-driven design or modular structure
   - Review `app/` folder organization

3. **Configuration Review**
   - Check `config/` files for custom configurations
   - Review `bootstrap/app.php` for middleware and providers
   - Examine `.env.example` for required environment variables

### Phase 2: Performance Analysis

#### Database Performance

```php
// Check for N+1 query problems
// PROBLEM: Lazy loading in loops
foreach ($posts as $post) {
    echo $post->author->name; // N+1 query
}

// SOLUTION: Eager loading
$posts = Post::with('author')->get();
```

**Scan for:**
- [ ] Missing eager loading (`with()`, `load()`)
- [ ] Queries inside loops
- [ ] Missing database indexes on foreign keys
- [ ] Missing indexes on frequently queried columns
- [ ] Large `SELECT *` queries without column selection
- [ ] Missing pagination on large datasets

**Commands:**
```bash
# Find potential N+1 issues
rg "->get\(\)|->all\(\)|->first\(\)" --type php -A 5 | grep -E "foreach|->.*->"

# Check migrations for indexes
rg "->index\(|->unique\(|->foreign\(" database/migrations/
```

#### Caching Opportunities

- [ ] Expensive queries without caching
- [ ] Repeated identical queries
- [ ] Config/route caching in production
- [ ] Missing view caching
- [ ] API responses without cache headers

```php
// Identify cacheable patterns
// BEFORE: Runs every request
$settings = Setting::all();

// AFTER: Cached
$settings = Cache::remember('settings', 3600, fn() => Setting::all());
```

#### Queue Usage

- [ ] Long-running operations not queued
- [ ] Email sending synchronous
- [ ] File processing in request cycle
- [ ] External API calls blocking responses

### Phase 3: Technical Debt Identification

#### Code Smells to Find

| Smell | Indicator | Grep Pattern |
|-------|-----------|--------------|
| TODOs | Unfinished work | `// TODO\|// FIXME\|// HACK\|// XXX` |
| Dead Code | Unused methods/classes | IDE analysis needed |
| Long Methods | > 50 lines | Manual review |
| God Classes | > 500 lines | `wc -l app/**/*.php` |
| Magic Numbers | Hardcoded values | `[^a-z][0-9]{2,}[^a-z]` |
| Duplicate Code | Copy-paste | Similar code blocks |

**Scan Commands:**
```bash
# Find TODOs and FIXMEs
rg "TODO|FIXME|HACK|XXX|@deprecated" --type php

# Find large files (potential god classes)
find app -name "*.php" -exec wc -l {} + | sort -rn | head -20

# Find long methods (rough estimate)
rg "function\s+\w+\(" --type php -c | sort -t: -k2 -rn | head -20

# Find commented-out code
rg "^\s*//\s*(public|private|protected|function|class|if|for|while)" --type php
```

#### Deprecated Patterns

- [ ] Using `env()` outside config files
- [ ] Old array syntax `array()` vs `[]`
- [ ] Legacy helper functions vs facades
- [ ] Deprecated Laravel methods
- [ ] PHP 7.x patterns in PHP 8.x codebase

#### Inconsistencies

- [ ] Mixed naming conventions (camelCase vs snake_case)
- [ ] Inconsistent return types
- [ ] Mixed validation styles (inline vs Form Request)
- [ ] Inconsistent error handling

### Phase 4: Architecture Conformance

#### Laravel Conventions Check

| Area | Convention | Check |
|------|------------|-------|
| Controllers | Singular, suffixed | `UserController` not `UsersCtrl` |
| Models | Singular | `User` not `Users` |
| Migrations | Snake case, descriptive | `create_users_table` |
| Views | Dot notation folders | `users.index` |
| Routes | Kebab case URLs | `/user-profiles` |

#### SOLID Principles Audit

**Single Responsibility:**
```bash
# Controllers doing too much (should delegate to services/actions)
rg "class.*Controller" -A 100 --type php | grep -c "function "
```

**Dependency Injection:**
```bash
# Check for service container usage vs manual instantiation
rg "new [A-Z][a-zA-Z]+\(" app/ --type php
```

#### Layer Separation

- [ ] Controllers only handle HTTP concerns
- [ ] Business logic in Services/Actions
- [ ] Models handle data and relationships
- [ ] No database queries in views
- [ ] No HTTP logic in models

### Phase 5: Dependency Health

#### Composer Packages

```bash
# Check for outdated packages
composer outdated

# Check for security vulnerabilities
composer audit

# List unused dependencies (requires analysis)
composer show --direct
```

**Review:**
- [ ] All dependencies actively maintained
- [ ] No abandoned packages
- [ ] Appropriate version constraints
- [ ] Dev dependencies properly separated

#### NPM Packages

```bash
# Check for outdated packages
npm outdated

# Check for vulnerabilities
npm audit

# Find unused dependencies
npx depcheck
```

#### Version Constraints

```json
// RISKY: Too loose
"laravel/framework": "*"
"laravel/framework": ">=10.0"

// SAFE: Semver compliant
"laravel/framework": "^11.0"
"laravel/framework": "~11.0.0"
```

### Phase 6: Code Quality Metrics

#### Test Coverage

```bash
# Run tests with coverage
php artisan test --coverage

# Check for untested files
find app -name "*.php" -exec basename {} \; | sort > app_files.txt
find tests -name "*.php" -exec grep -l "class" {} \; | xargs grep -h "test" | sort > tested.txt
```

**Review:**
- [ ] Critical paths have tests
- [ ] Edge cases covered
- [ ] Integration tests for key flows
- [ ] No tests with `markTestSkipped`

#### Documentation

- [ ] README up to date
- [ ] API documentation exists
- [ ] Complex methods have docblocks
- [ ] Environment variables documented

#### Code Formatting

```bash
# Check Pint compliance
./vendor/bin/pint --test

# Check ESLint/Prettier
npm run lint
```

### Phase 7: Generate Health Report

## Output Format

```markdown
# Codebase Health Report
**Project:** [Name]
**Date:** [Date]
**Laravel:** [Version]
**PHP:** [Version]

## Health Score: X/100

### Summary
| Category | Score | Issues |
|----------|-------|--------|
| Performance | X/20 | X issues |
| Tech Debt | X/20 | X issues |
| Architecture | X/20 | X issues |
| Dependencies | X/20 | X issues |
| Code Quality | X/20 | X issues |

---

## Performance Issues

### Critical
1. **N+1 Query in PostController::index**
   - File: `app/Http/Controllers/PostController.php:25`
   - Impact: ~100 extra queries per page load
   - Fix: Add `->with('author', 'comments')`

### Warnings
...

---

## Technical Debt

### TODOs Found: X
| File | Line | Note |
|------|------|------|
| ... | ... | ... |

### Large Files (> 300 lines)
| File | Lines | Recommendation |
|------|-------|----------------|
| ... | ... | ... |

---

## Architecture Issues
...

---

## Dependency Concerns

### Outdated Packages
| Package | Current | Latest | Risk |
|---------|---------|--------|------|
| ... | ... | ... | ... |

### Security Vulnerabilities
...

---

## Recommendations

### Immediate (This Sprint)
1. ...

### Short Term (This Month)
1. ...

### Long Term (Roadmap)
1. ...
```

## Post-Review Actions

1. Present findings organized by priority
2. Offer to create GitHub issues for identified problems
3. Suggest which items to tackle first based on impact
4. Provide estimates of complexity for fixes
5. Recommend follow-up reviews for specific areas
