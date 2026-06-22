<?php

namespace App\Enums;

enum TransactionCategory: string
{
    // expenses
    case Food = 'food';

    case Lifestyle = 'lifestyle';

    case Transport = 'transport';

    case AISubstription = 'ai-subscription';

    case InternetData = 'internet-data';

    case GiftGiven = 'gift-given';

    case Miscellaneous = 'miscellaneous';

    case Airtime = 'airtime';

    case GasRefill = 'gas-refill';

    case Others = 'others';

    // incomes
    case Salary = 'salary';

    case GiftRecieved = 'gift-recieved';

    /**
     * Get the human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Food => 'Food',
            self::Lifestyle => 'Life Style',
            self::Transport => 'Transport',
            self::AISubstription => 'AI Subscription',
            self::InternetData => 'Internet Data',
            self::GiftGiven => 'Gift Given',
            self::Airtime => 'Airtime',
            self::GasRefill => 'Gas Refill',
            self::Miscellaneous => 'Miscellaneous',
            self::Others => 'Others',
            self::Salary => 'Salary',
            self::GiftRecieved => 'Gift Received',
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

    /**
     * Get expense categories.
     */
    public static function expenses(): array
    {
        return [
            self::Food,
            self::Lifestyle,
            self::Transport,
            self::AISubstription,
            self::InternetData,
            self::GiftGiven,
            self::Airtime,
            self::GasRefill,
            self::Miscellaneous,
            self::Others,
        ];
    }

    /**
     * Get income categories.
     */
    public static function incomes(): array
    {
        return [
            self::Salary,
            self::GiftRecieved,
            self::Others,
        ];
    }
}
