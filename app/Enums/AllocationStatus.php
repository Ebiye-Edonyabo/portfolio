<?php

namespace App\Enums;

enum AllocationStatus: string
{
    case Pending = 'pending';
    case Funded = 'funded';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Funded => 'Funded',
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
