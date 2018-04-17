<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 11/02/2018
 * Time: 05:22 PM
 */

namespace Modules\Company\Jobs;


use Modules\Company\Models\Company;
use Modules\Users\Models\User;

class CreateCompany
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $data;

    /**
     * CreateCompany constructor.
     * @param User $user
     * @param array $data
     */
    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {
        if(!isset($this->data['company'])) return;

        Company::create([
            'user_id' => $this->user->id,
            'name' => $this->data['company'],
            'email' => $this->data['email'],
        ]);
    }

}