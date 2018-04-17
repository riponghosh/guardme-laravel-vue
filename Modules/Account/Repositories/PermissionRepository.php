<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 26/01/2018
 * Time: 09:32 AM
 */

namespace Modules\Account\Repositories;


use Modules\Account\Models\Permission;

class PermissionRepository
{
    /**
     * @var Permission
     */
    private $permission;


    /**
     * PermissionRepository constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * @param array $data
     * @return Permission
     */
    public function savePermission(array $data)
    {
        return $this->permission->create([
            'module' => $data['module'],
            'name' => $data['name']
        ]);
    }
}