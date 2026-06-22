<?php

namespace Database\Seeders;

use App\Enums\TransactionCategory;
use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            // May 27
            ['date' => '2026-05-27', 'description' => 'Light', 'amount' => 39700, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-05-27', 'description' => 'AI', 'amount' => 30000, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-05-27', 'description' => 'Silverman (Borrowed)', 'amount' => 8000, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-05-27', 'description' => 'Alabor (Borrowed)', 'amount' => 14000, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-05-27', 'description' => 'Custard', 'amount' => 5500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => '3 Crown Milk', 'amount' => 3000, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Loyal Milk', 'amount' => 4000, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Gino Tomato (5 Sachet)', 'amount' => 800, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Toothbrush ( 2pck)', 'amount' => 1200, 'category' => TransactionCategory::Others],
            ['date' => '2026-05-27', 'description' => 'Beans', 'amount' => 4500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Onions', 'amount' => 500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Granded Pepper', 'amount' => 1000, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Cray fish', 'amount' => 500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Spice', 'amount' => 2500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => 'Ironing of clothes', 'amount' => 3300, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-05-27', 'description' => 'Bread', 'amount' => 2500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-27', 'description' => '2 Malta + Water (Alb)', 'amount' => 1900, 'category' => TransactionCategory::Food],
            // May 28
            ['date' => '2026-05-28', 'description' => 'Noodles', 'amount' => 9800, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Spice', 'amount' => 600, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Meat', 'amount' => 3000, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Egusi', 'amount' => 1400, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Pepper', 'amount' => 500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Golden Morn', 'amount' => 4500, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-28', 'description' => 'Hair Spray', 'amount' => 2500, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-05-28', 'description' => 'Iceberg with Oke', 'amount' => 13000, 'category' => TransactionCategory::Lifestyle],
            // May 29
            ['date' => '2026-05-29', 'description' => 'Withdrawn', 'amount' => 3100, 'category' => TransactionCategory::Miscellaneous],
            // May 30
            ['date' => '2026-05-30', 'description' => 'Jen Data', 'amount' => 1500, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-05-30', 'description' => 'Barb', 'amount' => 1500, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-05-30', 'description' => 'Meat', 'amount' => 2000, 'category' => TransactionCategory::Food],
            ['date' => '2026-05-30', 'description' => 'Egg', 'amount' => 5500, 'category' => TransactionCategory::Food],
            // May 31
            ['date' => '2026-05-31', 'description' => 'Blessing Marriage', 'amount' => 10000, 'category' => TransactionCategory::Others],
            // June 1
            ['date' => '2026-06-01', 'description' => 'Withdrawn', 'amount' => 3100, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-06-01', 'description' => 'Deal', 'amount' => 5850, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-06-01', 'description' => 'Oil perfume', 'amount' => 1700, 'category' => TransactionCategory::Lifestyle],
            ['date' => '2026-06-01', 'description' => 'Groundnut', 'amount' => 2000, 'category' => TransactionCategory::Food],
            // June 2
            ['date' => '2026-06-02', 'description' => 'Fresh Tomato', 'amount' => 1500, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-02', 'description' => 'Pepper', 'amount' => 500, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-02', 'description' => 'Bread', 'amount' => 2500, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-02', 'description' => 'Peanut', 'amount' => 500, 'category' => TransactionCategory::Food],
            // June 3
            ['date' => '2026-06-03', 'description' => 'Jen Data', 'amount' => 1500, 'category' => TransactionCategory::Miscellaneous],
            // June 5
            ['date' => '2026-06-05', 'description' => 'Bread', 'amount' => 2500, 'category' => TransactionCategory::Food],
            // June 6
            ['date' => '2026-06-06', 'description' => 'Offering', 'amount' => 1000, 'category' => TransactionCategory::Others],
            // June 7
            ['date' => '2026-06-07', 'description' => 'Withdrawn', 'amount' => 3100, 'category' => TransactionCategory::Miscellaneous],
            ['date' => '2026-06-07', 'description' => 'Tomato', 'amount' => 1500, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-07', 'description' => 'Pepper', 'amount' => 800, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-07', 'description' => 'Okro', 'amount' => 1000, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-07', 'description' => 'Onions', 'amount' => 200, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-07', 'description' => 'Ojeja Leave', 'amount' => 200, 'category' => TransactionCategory::Food],
            // June 8
            ['date' => '2026-06-08', 'description' => 'Meat', 'amount' => 5000, 'category' => TransactionCategory::Food],
            ['date' => '2026-06-08', 'description' => 'Onions', 'amount' => 200, 'category' => TransactionCategory::Food],
            // June 9
            ['date' => '2026-06-09', 'description' => 'Jen', 'amount' => 3000, 'category' => TransactionCategory::Miscellaneous],
        ];

        foreach ($expenses as $expense) {
            Transaction::create([
                'date' => $expense['date'],
                'type' => TransactionType::Expense,
                'category' => $expense['category'],
                'description' => $expense['description'],
                'amount' => $expense['amount'],
            ]);
        }
    }
}
