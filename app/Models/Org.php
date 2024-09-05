<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    protected $table = 'schools';
    protected $fillable = ['name', 'website', 'created'];

    public function perms()
    {
        return $this->hasMany(Perm::class, 'org_id', 'id');
    }
}
