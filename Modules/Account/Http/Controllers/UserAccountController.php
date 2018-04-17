<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Account\Http\Resources\UserAccountProfileResource;
use Modules\Account\Jobs\PrefetchPageData;
use Modules\Account\Jobs\SendWelcomeMail;
use Modules\Servermessenger\Messenger\Task\TaskProducer;

class UserAccountController extends Controller
{
    public function updateAccount()
    {
        $data = \request()->all();
        $user = auth()->guard('api')->user();

        $user->email = $data['email'];
        $user->username = $data['username'];

        $user->save();

        if(isset($data['setup']) && $data['setup'])
        TaskProducer::publish(new SendWelcomeMail($user->id));

        return $user;
    }
    public function accountProfile(Request $request)
    {
        /*
         * User is requesting for account profile
         *
         * Send a job to ServerMessenger to prepare future data
         * (data that we anticipate will be requested by the system soon
         * such as, feeds, notifications etc)
         *
         * The anticipated future data is subject to the current page being visited by the user
         * Current page viewed by the user is passed as a query parameter in this request
         */

        // TaskProducer::publish(new PrefetchPageData($request));

        return new UserAccountProfileResource(auth()->user());
    }
}
