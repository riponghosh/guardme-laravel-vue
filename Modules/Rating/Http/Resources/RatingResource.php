<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/03/2018
 * Time: 12:54 PM
 */

namespace Modules\Rating\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class RatingResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

}