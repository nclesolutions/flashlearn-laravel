<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perm extends Model
{
    protected $table = 'students';
    protected $fillable = ['user_id', 'org_id', 'perm'];

    public function org()
    {
        return $this->belongsTo(Org::class, 'org_id', 'id');
    }
}
