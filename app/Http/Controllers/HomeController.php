<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\House;
use App\Models\TenantLedger;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index()
    {

        $user = Auth::user()->id;

        $houses = House::where('created_by', $user)->count();
        $shops = Flat::where(['type' => 'shop', 'created_by' => $user])->count();
        $apartments = Flat::where(['type' => 'apartment', 'created_by' => $user])->count();
        $collection = TenantLedger::where('account_id', '!=', 0)->sum('cr');

        // today variable is
        $today = date("Y-m-d");

        $collection_today = TenantLedger::where('account_id', '!=', 0)->where('action_date', date('Y-m-d'))->sum('cr');

        // dd($collection);
        return view('dashboard', compact('houses', 'shops', 'apartments', 'collection_today'));
    }
}
