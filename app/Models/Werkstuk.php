<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Werkstuk extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'niveau',
        'vak',
        'content',
        'owner_id',
        'updated_at',
        'created_at',
    ];
}
