<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class DashboardAccountController extends Controller
{
    public function dashboardAccount(){
        $user = Auth::user();
        // dd($user);
        return view('client.main-contents.accountDashBoard.index', compact('user'));
    }
}
