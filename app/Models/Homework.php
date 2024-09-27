<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homework';

    protected $fillable = [
        'study_guide_id',  // Include study_guide_id if not present
        'unique_id',
        'subject',  // Assuming 'vak' is a valid column representing the subject
        'title',
        'content',  // Correct field name for description
        'return_date'  // Correct field name for due date
    ];

    // Relatie met het Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
