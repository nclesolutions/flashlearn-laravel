<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absence';
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $fillable = ['user_id', 'reden', 'begintijd', 'eindtijd', 'gemaakt_date'];
}
