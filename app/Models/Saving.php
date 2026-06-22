<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = [
        'saving_plan_id',
        'amount',
        'date',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function savingPlan()
    {
        return $this->belongsTo(SavingPlan::class);
    }
}
