<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Correcte import

class Flashcard extends Model
{
    use HasFactory;

    // Relatie met Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    protected $fillable = ['subject_id', 'user_id', 'question', 'answer'];

    // Define the many-to-many relationship with User
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('correct')
                    ->withTimestamps();
    }
}