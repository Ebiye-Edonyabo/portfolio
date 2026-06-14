<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'route_url',
        'technologies',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'status' => Status::class,
        ];
    }
}
