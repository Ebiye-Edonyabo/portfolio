<?php

namespace App\Models;

use App\Enums\Status;
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
        'projects',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'responsibilities' => 'array',
            'technologies' => 'array',
            'projects' => 'array',
            'status' => Status::class,
        ];
    }
}
