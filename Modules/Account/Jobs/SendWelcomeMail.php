<?php

namespace Modules\Account\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\UserMessenger\Channels\Email;
use Modules\UserMessenger\Mail\PreparedEmail;
use Modules\Users\Repositories\UsersRepository;

class SendWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $user_id;

    /**
     * @var
     */
    private $subject;

    /**
     * Create a new job instance.
     *
     * @param $user_id
     * @param $subject
     */
    public function __construct($user_id, $subject = 'Welcome to GuardMe')
    {
        $this->user_id = $user_id;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = app(UsersRepository::class)->getUserById($this->user_id);

        /**
         * @var Email $email
         */
        $email = app(Email::class);
        $email->send($user->email, PreparedEmail::class, [
            'usermessenger::emails.confirmation', compact('user'), $this->subject
        ]);

    }
}
