<?php

namespace App\Models;

use App\Enums\AllocationStatus;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => AllocationStatus::class,
        ];
    }
}
