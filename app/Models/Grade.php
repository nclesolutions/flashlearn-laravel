<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'tbl_cijfers'; // Specify the table name

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'vak_id');
    }
}
