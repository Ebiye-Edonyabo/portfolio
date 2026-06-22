<?php

namespace App\Models;

use App\Enums\SavingsPlatform;
use Illuminate\Database\Eloquent\Model;

class SavingPlan extends Model
{
    protected $fillable = [
        'name',
        'platform_name',
        'target',
        'purpose',
        'is_locked',
        'duration',
        'time_line',
    ];

    protected function casts(): array
    {
        return [
            'is_locked' => 'boolean',
            'platform_name' => SavingsPlatform::class,
        ];
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
}
