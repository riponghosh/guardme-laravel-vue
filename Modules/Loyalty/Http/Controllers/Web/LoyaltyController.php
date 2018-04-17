<?php

namespace Modules\Loyalty\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Loyalty\Repositories\LoyaltyRepository;

class LoyaltyController extends Controller
{
    private $moduleName = 'loyalty';

    private $loyalty;

    public function __construct(LoyaltyRepository $loyalty)
    {
        $this->loyalty = $loyalty;
    }

    public function index()
    {
        $filter = request('filter');
        $referral_code = auth()->user()->referral_code;
        if($filter === 'expired'):
            $expired_lists = $this->loyalty->getExpiredList();
            $expired_lists->withPath("loyalty?filter=$filter");
        elseif(in_array($filter, ['newest', 'oldest', ''])):
            $loyalties = $this->loyalty->all($filter);
            $loyalties->withPath("loyalty?filter=$filter");
        endif;

        return view($this->moduleName . '::index', compact('loyalties', 'expired_lists', 'referral_code'));
    }

    public function insertReferralCode()
    {
        $code = $this->loyalty->referralCodeCheck(request('code'));

        // todo fix it as per revision

/*        Referral::create([
            'user_id' => auth()->user()->id,
            'code' => $code
        ]);*/

        return response()->json(['status' => 1, 'message' => 'Successfully inserted Referral Code', 'code' => $code]);
    }

    public function creditHistory()
    {
        $filter = \request('filter');
        $total_credit = $this->loyalty->getTotalRedeemedCredit();
        $credit_history = $this->loyalty->getRedeemCredit(1, $filter);
        return view($this->moduleName . '::credit_history', compact('credit_history', 'total_credit'));
    }

    public function redeemCredit()
    {
        $redeem_credit = $this->loyalty->getRedeemCredit();
        return view($this->moduleName . '::redeem_credit', compact('redeem_credit'));
    }

    public function getRedeemCreditById()
    {
        $id = request('id');
        $redeem_credit = $this->loyalty->getRedeemCreditById($id);
        return response()->json(['status' => true, 'data' => $redeem_credit]);
    }
    
    public function submitRedeemCredit(Request $request)
    {
        $store = [
          'id' => $request->referral_credit_id,
          'postage_address'=> $request->postage_address,
        ];
        $this->loyalty->storeRedeemCredit($store);
        return redirect()->back();
    }

    public function getRandom4()
    {
        $number = $this->loyalty->generateRandom4();
        return response()->json(['status' => true, 'data' => ['number' => $number]]);
    }
}
