<?php

namespace App\Enums;

enum Status: string
{
    case Draft = 'draft';
    case Published = 'published';

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
