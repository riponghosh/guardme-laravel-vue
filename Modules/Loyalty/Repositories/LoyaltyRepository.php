<?php
/**
 * Created by PhpStorm.
 * User: anandia
 * Date: 3/9/18
 * Time: 8:41 AM
 */

namespace Modules\Loyalty\Repositories;

use Illuminate\Http\Request;
use Modules\Loyalty\Models\ReferralCredit;
use Modules\Users\Models\User;

class LoyaltyRepository
{
    const COUNT_IN_ONE_PAGE = 10;

    protected function getUserId(){
        return auth()->user()->id;
    }

    public function all($filter = '')
    {
        $user_id = $this->getUserId();
        $user = User::where('referrer_id', $user_id);

        if($filter == 'newest'){
            $user->orderBy('registered_date', 'desc');
        }elseif ($filter == 'oldest'){
            $user->orderBy('registered_date', 'asc');
        }

        return $user->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function getExpiredList()
    {
        $user_id = $this->getUserId();
        $days_ago = date("Y-m-d", strtotime("-30 day"));
/*        return Referral::where('user_id', $user_id)
                         ->where('updated_at', '<', $days_ago)
                         ->paginate(static::COUNT_IN_ONE_PAGE);*/
    }

    public function getRedeemCredit($is_redeemed = 0, $filter = null)
    {
        $return = ReferralCredit::with(['job', 'user'])
                    ->where('is_redeemed', $is_redeemed)
                    ->where('referral_id', auth()->user()->id);

        if($filter == 'newest'){
            $return->orderBy('date_redeemed', 'desc');
        }elseif ($filter == 'oldest'){
            $return->orderBy('date_redeemed', 'asc');
        }

        return $return->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function getTotalRedeemedCredit()
    {
        $return = ReferralCredit::where('is_redeemed', 0)
            ->where('referral_id', auth()->user()->id)
            ->sum('credit');

        return $return;
    }

    public function getRedeemCreditById($id)
    {
        $user_id = auth()->user()->id;
        $return = ReferralCredit::where('id', $id)->where('referral_id', $user_id)->first()->toArray();
        $return['total_credit'] = ReferralCredit::where('referral_id', $user_id)->sum('credit');
        return $return;
    }

    public function storeRedeemCredit($store)
    {
        $data = [
          'is_redeemed' => 1,
          'date_redeemed' => now(),
        ];
        $result = array_merge($store, $data);
        return ReferralCredit::where('id', $store['id'])->update($result);
    }

    public function referralCodeCheck($code)
    {
        $count = User::where('referral_code', $code)->get()->count();
        if($count > 0) {
            return $this->generateRandom4();
        }
        return $code;
    }

    public function generateRandom4()
    {
        $number = "";
        for ($i = 0; $i < 4; $i++) {
            $min = ($i == 0) ? 1 : 0;
            $number .= mt_rand($min, 9);
        }

        $count = User::where('referral_code', $number)->get()->count();
        if($count > 0) $this->generateRandom4();

        return $number;
    }
}