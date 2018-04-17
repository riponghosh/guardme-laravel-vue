<?php
/**
 * Created by PhpStorm.
 * User: anandia
 * Date: 3/9/18
 * Time: 8:43 AM
 */

namespace Modules\Loyalty\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Jobs\Models\Job;

class ReferralCredit extends Model
{
    protected $fillable = [
        'job_id',
        'user_id',
        'referral_id',
        'credit',
        'is_redeemed',
        'date_redeemed'
    ];

    protected $dates = [
      'date_redeemed'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}