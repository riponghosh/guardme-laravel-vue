<?php

namespace Modules\Account\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = ['id'];

    protected $table = 'permissions';

    public function roles()
    {
        return $this
            ->belongsToMany(Role::class, 'role_permissions','permission_id','role_id');
    }
}
