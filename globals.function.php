<?php

const YEAR_GENERATOR_CENTER = 'CENTER';
const YEAR_GENERATOR_TOP = 'TOP';
const YEAR_GENERATOR_BOTTOM = 'BOTTOM';

function publish($job){
    if(env('RABBITMQ_SERVER_ON') == true) {
        \Modules\Servermessenger\Messenger\Task\TaskProducer::publish($job);
    } else {
        if(method_exists($job, 'handle')){
            $job->handle();
        } else {
            event($job);
        }
    }
}

function generate_years($startAt = null, $count = 20, $format = YEAR_GENERATOR_CENTER){
    if(!$startAt) $startAt = date('Y');

    $years = [];

    switch (strtoupper($format)){
        case YEAR_GENERATOR_CENTER:
            $halves = round($count / 2);

            for($i = 0; $i < $halves; $i++){
                $years[] = $startAt + $halves - $i;
            }

            for($i = 0; $i < $halves; $i++){
                $years[] = $startAt - $i;
            }

            break;
        case YEAR_GENERATOR_TOP:
            for($i = 0; $i < $count; $i++){
                $years[] = $startAt - $i;
            }
            break;

        case YEAR_GENERATOR_BOTTOM:
            for($i = 0; $i < $count; $i++){
                $years[] = $startAt + $count - $i;
            }
            break;
    }
    return $years;
}

function getUserToken(\Modules\Users\Models\User $user = null){
    if(!$user) return null;

    return \JWTAuth::fromUser($user,[
        'user' => new \Modules\Account\Http\Resources\UserAccountProfileResource($user)
    ]);
}

function getAuthUserToken(){
    if(!$user = auth()->user()) return null;

    return getUserToken($user);
}

function getRequestUserToken(){
    if(!$user = request()->user()) return null;

    return getUserToken($user);
}

function isPath($path){
    return $path == currentRoutePath();
}

function currentRoutePath(){
    return currentRoute()->uri;
}

function currentRoute(){
    return \Route::current();
}

function hasRole($roles){
    /**
     * @var \Modules\Users\Models\User $user
     */
    $user = auth()->user();
    if($user){
        if(is_array($roles)){
            return $user->inRoles($roles);
        } elseif (is_string($roles)){
            return $user->hasRole($roles);
        }
    }

    return false;
}

function hasPermission($permissions){
    /**
     * @var \Modules\Users\Models\User $user
     */
    $user = auth()->user();
    if($user){
        if(is_array($permissions)){
            return $user->inRoles($permissions);
        } elseif (is_string($permissions)){
            return $user->hasRole($permissions);
        }
    }

    return false;
}

function to_db_date($string){
    $timestamp = strtotime($string);

    return date('Y-m-d', $timestamp);
}
function to_db_datetime($string){
    $timestamp = strtotime($string);

    return date('Y-m-d H:i:s', $timestamp);
}

function from_db_datetime($dateTime){
    $timestamp = strtotime($dateTime);

    return date('Y-m-d h:i:s A',$timestamp);
}

function strToDbTime($timeString)
{
    $timestamp = strtotime($timeString);

    return date('H:i:s',$timestamp);
}

function dbTimeToStr($time){
    $timestamp = strtotime($time);

    return date('h:i A',$timestamp);
}

function generateTokenFromEntity($entity){
    return \JWTAuth::fromUser($entity,[
        'entity' => $entity
    ]);
}