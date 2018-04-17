<?php

namespace Modules\Feedback\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Feedback\Events\FeedbackWasSubmitted;
use Modules\Feedback\Jobs\SaveFeedback;
use Modules\Users\Models\User;

class FeedbackController extends Controller
{
    public function saveFeedback()
    {
        $data = \request()->all();

        $data['auth_user'] = auth()->user()->id;

        publish(new FeedbackWasSubmitted($data));

        return $data;
    }

    public function showFeedbackPage()
    {
        return view('feedback::feedback');

    }
}
