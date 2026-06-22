<?php

namespace App\Enums;

enum SavingsPlatform: string
{
    case Piggyvest = 'piggyvest';

    public function label(): string
    {
        return match ($this) {
            self::Piggyvest => 'Piggyvest',
        };
    }

    /**
     * Get label options for select dropdowns.
     *
     * @return array<int, array{label: string, value: string}>
     */
    public static function options(): array
    {
        return array_map(fn ($case) => ['label' => $case->label(), 'value' => $case->value], self::cases());
    }
}
