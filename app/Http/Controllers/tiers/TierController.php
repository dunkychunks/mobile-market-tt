<?php

namespace App\Http\Controllers\tiers;

use App\Helpers\TierHelper;
use App\Http\Controllers\Controller;
use App\Models\tier\Tier;
use Illuminate\Support\Facades\Auth;

class TierController extends Controller
{
    public function index()
    {
        $tier_data = Tier::all();

        $tier_helper = new TierHelper(Auth::user()->load('tier'));
        $tier_helper->checkTierProgress();

        if (!$tier_helper->isValid()) {
            abort(404);
        }

        return view('pages.additional.tiers.user-tier-page', compact('tier_helper', 'tier_data'));
    }
}
