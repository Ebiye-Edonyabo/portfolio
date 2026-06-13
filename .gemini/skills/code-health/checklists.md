# Codebase Health Review Checklists

## Quick Health Check (5 minutes)

### Immediate Red Flags
- [ ] `APP_DEBUG=true` in production
- [ ] `dd()` or `dump()` in app code
- [ ] `env()` calls outside config files
- [ ] Hardcoded credentials or API keys
- [ ] Empty catch blocks
- [ ] Disabled CSRF protection

### Quick Stats to Gather
- [ ] Total PHP files in `app/`
- [ ] Total test files
- [ ] Test to code ratio
- [ ] Number of TODOs/FIXMEs
- [ ] Outdated composer packages
- [ ] Outdated npm packages

---

## Full Review Checklist

### 1. Project Structure

#### Directory Organization
- [ ] Standard Laravel structure followed
- [ ] Custom directories documented
- [ ] No orphaned files in root
- [ ] Consistent folder naming (PascalCase for PHP, kebab-case for views)

#### Configuration
- [ ] `.env.example` has all required variables
- [ ] Config files use `env()` with sensible defaults
- [ ] Sensitive config values not committed
- [ ] Environment-specific configs separated

### 2. Models & Database

#### Model Quality
- [ ] All models have `$fillable` or `$guarded`
- [ ] Relationships properly typed with return hints
- [ ] Casts defined for dates, booleans, JSON
- [ ] Accessors/mutators use PHP 8 attribute syntax
- [ ] No business logic in models (keep them data-focused)

#### Database Design
- [ ] All tables have proper indexes
- [ ] Foreign keys have indexes
- [ ] Frequently queried columns indexed
- [ ] Migrations are reversible (have `down()`)
- [ ] No raw SQL in migrations

#### Query Efficiency
- [ ] No N+1 queries (eager loading used)
- [ ] Large datasets paginated
- [ ] Expensive queries cached
- [ ] `select()` used to limit columns when needed
- [ ] Chunking used for batch operations

### 3. Controllers

#### Controller Design
- [ ] Controllers are thin (< 100 lines)
- [ ] Use Form Requests for validation
- [ ] Delegate logic to Services/Actions
- [ ] Proper HTTP status codes returned
- [ ] RESTful naming conventions followed

#### Authorization
- [ ] All routes have appropriate middleware
- [ ] Policy methods used for model authorization
- [ ] `authorize()` called in controller methods
- [ ] No authorization logic in views

### 4. Services & Actions

#### Business Logic Organization
- [ ] Complex logic extracted to Services or Actions
- [ ] Single responsibility per class
- [ ] Dependencies injected (not instantiated)
- [ ] Methods are testable in isolation
- [ ] Clear public interfaces

### 5. API Quality (if applicable)

#### API Design
- [ ] Consistent response format
- [ ] Proper HTTP methods used
- [ ] API Resources used for transformations
- [ ] Versioning strategy in place
- [ ] Rate limiting configured

#### API Security
- [ ] Authentication on all endpoints
- [ ] Authorization checks present
- [ ] Input validation on all endpoints
- [ ] Sensitive data not exposed

### 6. Frontend (Inertia/Vue)

#### Component Quality
- [ ] Components are focused (single purpose)
- [ ] Props properly typed
- [ ] No business logic in components
- [ ] Consistent naming conventions
- [ ] Reusable components in `components/`

#### Performance
- [ ] No unnecessary re-renders
- [ ] Large lists virtualized
- [ ] Images optimized
- [ ] Lazy loading where appropriate

### 7. Testing

#### Test Coverage
- [ ] Critical paths have tests
- [ ] Edge cases covered
- [ ] Error scenarios tested
- [ ] Authentication flows tested
- [ ] API endpoints tested

#### Test Quality
- [ ] Tests are independent
- [ ] Factories used for test data
- [ ] No hardcoded test data
- [ ] Tests run in isolation
- [ ] Descriptive test names

### 8. Error Handling

#### Exception Handling
- [ ] Custom exceptions for domain errors
- [ ] Exceptions caught at appropriate levels
- [ ] User-friendly error messages
- [ ] Errors logged appropriately
- [ ] No sensitive data in error messages

#### Logging
- [ ] Appropriate log levels used
- [ ] Contextual information included
- [ ] No sensitive data logged
- [ ] Log rotation configured

### 9. Performance

#### Application Performance
- [ ] Config cached in production
- [ ] Routes cached in production
- [ ] Views cached in production
- [ ] Autoloader optimized
- [ ] Queue worker running for heavy tasks

#### Database Performance
- [ ] Query logging shows no slow queries
- [ ] Indexes cover common queries
- [ ] N+1 queries eliminated
- [ ] Large operations use chunking

### 10. Code Quality

#### Standards Compliance
- [ ] PSR-12 coding standard followed
- [ ] Pint runs without changes
- [ ] No IDE warnings
- [ ] Consistent formatting throughout

#### Documentation
- [ ] README is current
- [ ] Complex methods have docblocks
- [ ] Public APIs documented
- [ ] Environment setup documented

---

## Review by File Type

### Migration Review Checklist
- [ ] Descriptive migration name
- [ ] `up()` and `down()` methods present
- [ ] Indexes on foreign keys
- [ ] Indexes on frequently queried columns
- [ ] Default values set appropriately
- [ ] Nullable defined correctly
- [ ] No data manipulation in structure migrations

### Controller Review Checklist
- [ ] Extends base Controller
- [ ] Uses Form Requests for validation
- [ ] Authorization checks present
- [ ] Thin methods (< 20 lines)
- [ ] Returns appropriate responses
- [ ] No direct model manipulation in complex operations

### Model Review Checklist
- [ ] `$fillable` or `$guarded` defined
- [ ] Relationships return typed
- [ ] Casts for non-string columns
- [ ] Scopes for common queries
- [ ] No complex business logic
- [ ] Factory exists for testing

### Form Request Review Checklist
- [ ] `authorize()` method implemented
- [ ] `rules()` returns array
- [ ] Custom messages where helpful
- [ ] Validation rules appropriate
- [ ] No business logic

### Service/Action Review Checklist
- [ ] Single responsibility
- [ ] Dependencies injected
- [ ] Public methods documented
- [ ] Returns consistent types
- [ ] Exceptions for error cases
- [ ] Testable in isolation

### Test Review Checklist
- [ ] Descriptive test name
- [ ] Arrange-Act-Assert structure
- [ ] One assertion per concept
- [ ] Uses factories
- [ ] Tests edge cases
- [ ] Independent of other tests

---

## Severity Ratings

### Critical (Fix Immediately)
- Security vulnerabilities
- Data loss potential
- Authentication bypasses
- SQL injection risks
- Hardcoded secrets

### High (Fix This Sprint)
- N+1 queries on high-traffic pages
- Missing authorization checks
- Performance bottlenecks
- Missing critical tests
- Deprecated code with security implications

### Medium (Fix This Month)
- Code style violations
- Missing indexes
- Incomplete documentation
- Test coverage gaps
- Suboptimal caching

### Low (Fix When Possible)
- Minor refactoring opportunities
- Nice-to-have optimizations
- Documentation improvements
- Code organization suggestions
- Future-proofing recommendations

---

## Post-Review Actions Template

```markdown
## Immediate Actions (Before Next Deploy)
1. [ ] Fix: [Critical Issue 1]
2. [ ] Fix: [Critical Issue 2]

## This Sprint
1. [ ] Address: [High Priority 1]
2. [ ] Address: [High Priority 2]

## Technical Debt Backlog
1. [ ] [Medium Priority 1]
2. [ ] [Medium Priority 2]

## Future Improvements
1. [ ] [Low Priority 1]
2. [ ] [Low Priority 2]

## Monitoring
- [ ] Set up alerting for [specific metric]
- [ ] Add logging for [specific operation]
```
