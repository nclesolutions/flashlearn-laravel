<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    // Define the relationship to the Teacher model
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'docent_id', 'id');
    }
}
