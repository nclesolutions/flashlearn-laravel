<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    // Define the relationship to the Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    // Relatie met de Homework-opdrachten op basis van de 'vak' kolom
    public function homework()
    {
        return $this->hasMany(Homework::class, 'vak', 'name');
    }
    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
}
