<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 27/09/2017
 * Time: 09:39 AM
 */

namespace Modules\Users\Repositories;


use Carbon\Carbon;
use Illuminate\Http\Response;
use Modules\Users\Models\User;

class UsersRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * UsersRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get filtered users.
     *
     * @param \stdClass $filters
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function filter(\stdClass $filters)
    {
        $query = $this->user;

        if (isset($filters->role))
        {
            $query = $query->whereHas('roles', function ($q) use ($filters) {
                $q->whereIn('id', [$filters->role]);
            });
        }

        if (isset($filters->status)) {
            $query = $query->where('status', $filters->status);
        }

        if (isset($filters->registered_before)) {
            $query = $query->where('created_at', '<=', new Carbon($filters->registered_before));
        }

        if (isset($filters->registered_after)) {
            $query = $query->where('created_at', '>=', new Carbon($filters->registered_after));
        }

        if (isset($filters->city)) {
            $query = $query->where('city_id', $filters->city);
        }

        return $query->with('roles', 'city', 'city.county')
            ->get();
    }

    /**
     * Get unique available cities.
     *
     * @return mixed
     */
    public function getAvailableCitiesIds()
    {
        $ids   = [];
        $users = $this->user->whereNotNull('city_id')->distinct()->get(['city_id']);

        foreach ($users as $user) {
            $ids[] = $user->city_id;
        }

        return $ids;
    }

    /**
     * @param $user_id
     * @return User
     */
    public function getUserById($user_id)
    {
        return $this->user->find($user_id);
    }

    /**
     * @param $phone
     *
     * @return User
     */
    public function getUserByPhone($phone)
    {
        return $this->user->where('phone', $phone)
            ->first();
    }

    /**
     * @param $email
     *
     * @return User
     */
    public function getUserByEmail($email)
    {
        return $this->user->where('email', $email)
            ->first();
    }

    public function getRecommendedUsers()
    {
        return $this->user
            ->latest()
            ->has('posts', '>=', 4)
            ->take(20)
            ->get()
            ;
    }

    /**
     * @param $username
     * @return User
     */
    public function getUserByUsername($username)
    {
        return $this->user->where('username', $username)->first();
    }
}