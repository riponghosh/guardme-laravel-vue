<?php

namespace Modules\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class Role extends Model
{
    protected $guarded = ['id'];
    protected $table = 'roles';

    public function permissions()
    {
        return $this
            ->belongsToMany(Permission::class, 'role_permissions','role_id','permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles','role_id','user_id');
    }
}
