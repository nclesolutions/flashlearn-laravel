<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homework';

    protected $fillable = [
        'user_id',
        'unique_id',
        'vak',  // Assuming 'vak' is a valid column representing the subject
        'title',
        'beschrijving',  // Correct field name for description
        'inlever_date'  // Correct field name for due date
    ];

    // Relatie met het Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
