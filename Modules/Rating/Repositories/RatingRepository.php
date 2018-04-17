<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 12:55 PM
 */

namespace Modules\Rating\Repositories;


use Modules\Rating\Models\Rating;

class RatingRepository
{
    /**
     * @var Rating
     */
    private $rating;

    /**
     * RatingRepository constructor.
     * @param Rating $rating
     */
    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function getAllDefinedRatings()
    {
        return $this->rating->all();
    }

    /**
     * @param $rating_id
     * @return Rating
     */
    public function getRatingDefinitionById($rating_id)
    {
        return $this->rating->find($rating_id);
    }
}