<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Definieer hier de velden als je wilt
    protected $fillable = [
        'user_id', 'org_id', 'class_id', 'role', 'created_at', 'updated_at',
    ];
}
