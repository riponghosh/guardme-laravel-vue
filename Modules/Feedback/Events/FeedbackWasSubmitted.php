<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 01:47 PM
 */

namespace Modules\Feedback\Events;


class FeedbackWasSubmitted
{
    /**
     * @var array
     */
    public $data;


    /**
     * FeedbackWasSubmitted constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}