<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/12/2017
 * Time: 03:52 PM
 */

namespace Modules\Account\Traits;


use Modules\Account\Models\Permission;
use Modules\Account\Models\Role;
use Modules\Jobs\Models\JobEmployeesPivot;

trait UserAccountTrait
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles','user_id','role_id')
            ->withPivot('is_primary');
    }

    /**
     * @return Role
     */
    public function getPrimaryRole()
    {
        return $this->roles()->wherePivot('is_primary', true)->first();
    }

    public function permissions()
    {
        return $this
            ->belongsToMany(Permission::class, 'user_permissions','user_id','permission_id');
    }

    public function hasPermission($permission_name)
    {
        $permission = $this->permissions()
            ->whereName($permission_name)
            ->first();

        if($permission){
            return $permission;
        } else {
            return $this->roles()
                ->whereHas('permission', function($query) use($permission_name){
                    $query->where('name', $permission_name);
                })->count();
        }

        return false;
    }

    /**
     * Check if the user has the specified role
     *
     * @param $roleName
     * @return Role | bool
     */
    public function hasRole($roleName)
    {
        $role = $this->roles()
            ->whereName($roleName)
            ->first();

        return $role ?? false;
    }

    /**
     * Check if the user is assigned any role in the specified array
     * @param array $roleNames
     * @return bool
     */
    public function inRoles(array $roleNames)
    {
        $count = $this->roles()
            ->whereIn('name', $roleNames)
            ->count();

        return $count ?? false;
    }


    public function firstJobsApplications()
    {
        return $this->hasMany(JobEmployeesPivot::class, 'user_id', 'id')->limit(1);
    }
}