<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    //
    protected $table = "roles";
    protected $fillable = ["name", "guard_name"];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
