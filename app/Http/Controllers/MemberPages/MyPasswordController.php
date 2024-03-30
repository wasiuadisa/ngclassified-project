<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// This is required to enable
use Hash;

// Import the relevant model classes
use App\Models\User;

// Import the relevant request classes
use App\Http\Requests\PasswordChangingRequest;

// Import class to be able to use Authentication class
use Illuminate\Support\Facades\Auth;

class MyPasswordController extends Controller
{
    /**
     * Display password change form.
     * @return \Illuminate\Http\Response
     */
    public function passwordChangeForm()
    {
        //Show the Password Change form
        return view('site.member.my_password_change');
    }

    /**
     * Save data from password change form.
     * @return \Illuminate\Http\Response
     */
    public function passwordChangeProcessing(PasswordChangingRequest $request)
    {
        // Expected input
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        // Update the User password
        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($password)
        ]);

        //Cancel this User's session so he can log in with the new password
        $request->session()->invalidate();

        // Short message
        $request->session()->flash('membershipInfo', 'Congratulations! Your password has been updated to the new one. Please login with the new password, to continue.');

        // Redirect to the dashboard
        return redirect()->route('login');
    }
}
