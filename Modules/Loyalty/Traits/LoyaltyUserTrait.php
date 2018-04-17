<?php
/**
 * Created by PhpStorm.
 * User: anandia
 * Date: 3/13/18
 * Time: 11:38 PM
 */

namespace Modules\Loyalty\Traits;

use Modules\Loyalty\Models\ReferralCredit;

trait LoyaltyUserTrait
{
    public function loyalties()
    {
        return $this->hasMany(ReferralCredit::class, 'user_id', 'id');
    }
}