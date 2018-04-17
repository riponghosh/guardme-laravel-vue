<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 05/10/2017
 * Time: 11:14 AM
 */

namespace Modules\Servermessenger\Messenger\Task;


interface TaskableJob
{
    public function  serializeForWorker();

    public static function initializeFromWorker($data);

    public function handle();

}