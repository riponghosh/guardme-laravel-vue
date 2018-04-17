<?php

namespace Modules\App\Repositories;

use Modules\App\Models\City;
use Modules\Users\Repositories\UsersRepository;

class CityRepository
{
    /**
     * @var City
     */
    private $city;

    /**
     * CityRepository constructor.
     *
     * @param City $city
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Return all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPopulated()
    {
        $ids = app(UsersRepository::class)->getAvailableCitiesIds();

        return $this->city->whereIn('id', $ids)->with('county')->get();
    }
}