<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'period',
        'role',
        'company',
        'company_url',
        'location',
        'description',
        'responsibilities',
        'technologies',
    ];

    protected function casts(): array
    {
        return [
            'responsibilities' => 'array',
            'technologies' => 'array',
        ];
    }
}
