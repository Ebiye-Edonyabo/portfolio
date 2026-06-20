# Transaction System Implementation Guide

This document outlines the architecture, components, and logic of the Transaction tracking system built for the application.

## 1. Database & Models
### Migration
The `transactions` table tracks user incomes and expenses. The schema structure follows a strict order:
- `date` (date): The day the transaction occurred.
- `type` (string): Either `income` or `expense`.
- `category` (string): The specific category of the transaction.
- `description` (string): A brief note about the transaction.
- `amount` (decimal 12, 2): The monetary value.

### Model (`App\Models\Transaction`)
- Uses standard Laravel `$fillable` configuration matching the migration.
- Casts `type` to `App\Enums\TransactionType` and `category` to `App\Enums\TransactionCategory`.
- Casts `date` to `datetime`.

---

## 2. Enumerations (Enums)
To ensure data consistency, transaction Types and Categories are strictly typed via PHP 8.1 Backed Enums.

### `TransactionType`
Cases: `Income` ('income'), `Expense` ('expense').

### `TransactionCategory`
Provides the list of categories grouped by type.
- **Expenses**: `Food`, `Lifestyle`, `AISubstription`, `InternetData`, `GiftGiven`, `Miscellaneous`, `Others`.
- **Incomes**: `Salary`, `GiftRecieved`, `Others`.
- **Methods**:
  - `label()`: Returns a human-readable string (e.g., "Gift Received" instead of "gift-recieved").
  - `expenses()` / `incomes()`: Returns an array of valid cases for that specific type.

---

## 3. State Management (Livewire + Alpine.js)

The system leverages a hybrid approach combining Livewire for secure backend processing and Alpine.js for instantaneous frontend interactions.

### Livewire Component (`App\Livewire\Admin\Transactions`)
- **Pagination**: Limits history to 10 records per page.
- **Calculations**: Computes `$totalIncome`, `$totalExpense`, and `$balance` dynamically on render.
- **State Properties**: `$isCreating` and `$isEditing` determine the UI mode.
- **Data Passing**: Passes `$expenseCategories` and `$incomeCategories` to the blade view as structured arrays to power the Alpine.js dynamic dropdowns.

### Form Object (`App\Livewire\Forms\TransactionForm`)
Encapsulates all validation and database interaction logic.
- **Data Cleaning**: The `formatAmount()` method intercepts string values from the frontend (e.g., `"250,000.00"`) and securely strips out commas via `preg_replace` before executing Laravel's `numeric` validation.
- **CRUD**: Exposes `store()` and `update()` methods for clean controller code.

### Frontend Logic (`Alpine.js`)
To avoid slow server roundtrips, the Blade view is wrapped in an Alpine component (`x-data`) that handles:
1. **Dynamic Dropdowns**: Swapping the "Category" `<option>` list instantly when the "Type" changes.
2. **Instant Toggling**: Using `x-show` to reveal the create/edit form without reloading the page.
3. **Visual Formatting**: Automatically formatting the `amount` input to include commas and exactly two decimal places (`.00`) on blur, while deferring the actual network sync until form submission.

---

## 4. UI Components

### Reusable Modals & Notifications
- **Confirmation Modal (`<x-admin.confirmation-modal />`)**: A globally reusable, Alpine-powered component that replaces the browser's native `alert()`. It listens for the `@open-confirmation-modal.window` event and securely dispatches backend Livewire methods (e.g., `deleteTransaction`) upon user confirmation.
- **Toast Notifications (`<x-admin.toast />`)**: A global notification popup built into the `admin` layout. Livewire dispatches a browser event (`$this->dispatch('notification', message: '...')`) which Alpine catches to smoothly slide the toast in and out.

### Blade Components
- **`x-admin.stat-card`**: A reusable block for displaying the Total Income, Total Expense, and Balance summaries.
- **`x-admin.dropdown-input`**: A styled `<select>` wrapper component modified to support an optional `:live` property for real-time Livewire binding (when needed).
- **`x-admin.text-input`**: A standard text/date input wrapper.

### History Table
- Displays the date in `M d, Y` format.
- Uses the `label()` method to display human-readable enum values.
- Formats amounts with `number_format()`.
- Includes action buttons for entering Edit mode or Deleting records (with native wire:confirm prompts).
