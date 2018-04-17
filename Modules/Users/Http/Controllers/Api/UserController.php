<?php

namespace Modules\Users\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\App\Repositories\CityRepository;
use Modules\UserMessenger\Channels\Email;
use Modules\UserMessenger\Channels\SMS;
use Modules\UserMessenger\Mail\PreparedEmail;
use Modules\Users\Repositories\UsersRepository;
use Modules\Account\Repositories\RoleRepository;

class UserController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @var CityRepository
     */
    protected $city;

    /**
     * @var UsersRepository
     */
    protected $users;

    /**
     * UserController constructor.
     *
     * @param RoleRepository $role
     * @param CityRepository $city
     * @param UsersRepository $users
     */
    public function __construct(RoleRepository $role, CityRepository $city, UsersRepository $users)
    {
        $this->role  = $role;
        $this->city  = $city;
        $this->users = $users;
    }

    /**
     * Available values for filters.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function init()
    {
        $roles  = $this->role->all();
        $cities = $this->city->getPopulated();

        return compact('roles', 'cities');
    }

    /**
     * Get filtered results.
     *
     * @param Request $request
     *
     * @return array
     */
    public function filter(Request $request)
    {
        $filters = new \stdClass();

        foreach (['role', 'status', 'city', 'registered_before', 'registered_after'] as $filter)
        {
            $value = $request->get($filter);

            if ($value != '' && $value != '*') {
                @ $filters->{$filter} = $value;
            }
        }

        $users = app(UsersRepository::class)->filter($filters);

        return compact('users');
    }

    /**
     * Bulk messaging.
     *
     * @param Request $request
     *
     * @return string
     */
    public function bulk(Request $request)
    {
        // TODO: Add placeholders for message text.
        $to    = $request->get('to');
        $subj  = $request->get('subject');
        $text  = $request->get('message');
        $users = is_array($to) ? $this->filter(new Request($to))['users'] : [$this->users->getUserById($to)];

        foreach ($users as $user)
        {
            if ($request->get('type') === 'email') {
                app(Email::class)->send($user->email, PreparedEmail::class, [
                    'usermessenger::emails.plain', compact('text'), $subj
                ]);
            } else {
                app(SMS::class)->send($user->phone, $text);
            }
        }

        return 'OK';
    }
}
