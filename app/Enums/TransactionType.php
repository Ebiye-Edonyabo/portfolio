<?php

namespace App\Enums;

enum TransactionType: string
{
    case Income = 'income';

    case Expense = 'expense';

      /**
     * Get label options for select dropdowns.
     *
     * @return array<int, array{label: string, value: string}>
     */
    public static function options(): array
    {
        return array_map(fn ($case) => ['label' => $case->name, 'value' => $case->value], self::cases());
    }
}
