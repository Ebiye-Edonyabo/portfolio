<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'name',
        'logo_path',
        'order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
