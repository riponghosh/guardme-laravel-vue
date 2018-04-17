<?php

namespace Modules\Rating\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Rating\Http\Resources\RatingResource;
use Modules\Rating\Repositories\RatingRepository;

class RatingController extends Controller
{
    /**
     * @var RatingRepository
     */
    private $ratingRepository;

    /**
     * RatingController constructor.
     * @param RatingRepository $ratingRepository
     */
    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function fetchRatings()
    {
        $ratings = $this->ratingRepository->getAllDefinedRatings();

        return RatingResource::collection($ratings);
    }
}
