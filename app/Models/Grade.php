<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades'; // Specify the table name

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
