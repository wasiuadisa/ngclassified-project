<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
	/*
	 *
	 */
	public function __invoke()
	{
        // Get the user data a given memberID
        $user_user = (new \App\Logic\MemberProfiles)->memberProfileUserTable(Auth::user()->id);

        // Get the user data a given memberID
        $user_profile = (new \App\Logic\MemberProfiles)->memberProfileProfileTable(Auth::user()->id);

        // Set page
        $pageTitle = $user_user->firstname . '\'s Dashboard';

        return view('member.dashboard', [
            'user_user' => $user_user,
            'user_profile' => $user_profile,
            'pageTitle' => $pageTitle,
        ]);
	}
}