<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 01:33 PM
 */

namespace Modules\Feedback\Jobs;


class SaveFeedback
{
    /**
     * @var array
     */
    private $data;


    /**
     * SaveFeedback constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {

    }
}