<?php

namespace Modules\Account\Repositories;

use Modules\Account\Models\Role;

class RoleRepository
{
    /**
     * @var Role
     */
    private $role;

    /**
     * RoleRepository constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Return all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->role->all();
    }
}