<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

// Import models for database
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\MemberPages\ProfileEditingRequest;

class MemberProfileController extends Controller
{
    /**
     * Get profile of member with given ID
     * @param  int  $memberID
     */
    public function memberProfileView($memberID)
    {
        if(Auth::user()->id == $memberID)
        {
            // Send message
            session()->flash('membershipInfo', 'You can not view YOUR profile this way.');

            return redirect()->route('profile.view');
        }

        // Get the user data a given memberID
        $user_user = (new \App\Logic\MemberProfiles)->memberProfileUserTable($memberID);

        // Get the user data a given memberID
        $user_profile = (new \App\Logic\MemberProfiles)->memberProfileProfileTable($memberID);

        // Increase view count of a user profile using given memberID
        (new \App\Logic\MemberProfiles)->increaseViewCountForMemberProfile($memberID);

        // Set page
        $pageTitle = $user_user->firstname . '\'s profile';

        return view('member.member_profile_view', [
            'user_user' => $user_user,
            'user_profile' => $user_profile,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Get profile of current user
     */
    public function profileView()
    {
        // The user_data values exist already in the current user session(Auth::user())

        // Get the user data a given memberID
        $user_profile = (new \App\Logic\MemberProfiles)->memberProfileProfileTable(Auth::user()->id);

        return view('member.my_profile', [
            'user_profile' => $user_profile,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {
        // The user_data values exist already in the current user session(Auth::user())

        // Get the user table data for logged-in user
        $user_user = (new \App\Logic\MemberProfiles)->memberProfileUserTable(Auth::user()->id);

        // Get the profile table data for logged-in user
        $user_profile = (new \App\Logic\MemberProfiles)->memberProfileProfileTable(Auth::user()->id);

        return view('member.my_profile_edit', [
            'pageTitle' => 'Editing ' . $user_user->firstname . '\'s profile.',
            'user_user' => $user_user,
            'user_profile' => $user_profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileEditProcessing(ProfileEditingRequest $request)
    {
        // Ensure that the hidden ID in the form is the logged-in user's ID
        if($request->input('ID') == Auth::user()->id)
        {
            // Send warning
            session()->flash('membershipInfo', 'You should use the appropriate links provided by this site. Stop trying to hack this site or you will be penalised.');

            // If the ID is not the logged-in user's, redirect to the dashboard
            return redirect()->route('member.dashboard');
        }

        if($request->file('profilePhoto') != '')
        {
            //Get filename and extension
            $profileImage = $request->file('profilePhoto'); //This will have filename and its extension

            //Hash the filename
            $profileImageHashedName = hash('ripemd160', time().$profileImage->getClientOriginalName()).'.'.$profileImage->getClientOriginalExtension();

            //Provide a destination path for saving the file to.
            $destinationPath_image = public_path('profile/');

            //Move the image to the destination path
            $profileImage->move($destinationPath_image, $profileImageHashedName);

            // Update the user with profile image filename.
            User::where('id', Auth::user()->id)->update([
                'profileimage'       => $profileImageHashedName,
            ]);
        }

/*        // Check if it's the same email address. Leave as is, if it is
        if(Auth::user()->email == $request->input('email'))
        {
            // Update the user data excluding the email column
            User::where('deactivated', 0)->where('id', Auth::user()->id)->update([
                'firstname'     => $request->input('firstname'),
                'middlename'    => $request->input('middlename'),
                'surname'       => $request->input('surname'),
                'updated_at'    => now(),
            ]);
        }
        else {
            // Update the user data including the email column
            User::where('deactivated', 0)->where('id', Auth::user()->id)->update([
                'firstname'     => $request->input('firstname'),
                'middlename'    => $request->input('middlename'),
                'surname'       => $request->input('surname'),
                'email'         => $request->input('email'),
                'updated_at'    => now(),
            ]);   
        }
*/
        // Update the user data excluding the email column
        User::where([
            ['banned', '=', 0],
            ['suspended', '=', 0],
            ['deactivated', '=', 0],
            ['id', '=', Auth::user()->id]
        ])->update([
            'firstname'     => $request->input('firstname'),
            'middlename'    => $request->input('middlename'),
            'surname'       => $request->input('surname'),
            'updated_at'    => now(),
        ]);

        // Update the referral request application of the logged-in user.
        // The updateOrInsert() requires a pair of 2 key parameters. But because of normalization, Profile database can only provide one, the users_id. So i've resorted to a hack or manual solution
        $foundAnEntry = Profile::where('users_id', Auth::user()->id)->count();

        if($foundAnEntry > 0)
        {
            //Update the existing entry
            Profile::where('users_id', Auth::user()->id)->update([
                'date_of_birth' => filter_var($request->input('date_of_birth'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'gender' => filter_var($request->input('gender'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'state' => filter_var($request->input('state'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'city' => filter_var($request->input('city'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'address' => filter_var($request->input('address'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'postcode' => filter_var($request->input('postcode'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'phone' => filter_var($request->input('phone'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'about_me' => filter_var($request->input('about_me'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'hobbies' => filter_var($request->input('hobbies'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'religion' => filter_var($request->input('religion'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'religious_level' => filter_var($request->input('religious_level'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW),
                'updated_at'     => now()
            ]);
        }
        else {
            // There's no entry yet for this user, so create his profile now
            $newProfile         = new Profile;

            $newProfile->date_of_birth = filter_var($request->input('date_of_birth'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->gender = filter_var($request->input('gender'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->state = filter_var($request->input('state'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->city = filter_var($request->input('city'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->address = filter_var($request->input('address'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->postcode = filter_var($request->input('postcode'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->phone = filter_var($request->input('phone'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->about_me = filter_var($request->input('about_me'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->hobbies = filter_var($request->input('hobbies'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->religion = filter_var($request->input('religion'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->religious_level = filter_var($request->input('religious_level'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_LOW);
            $newProfile->updated_at = now();
            $newProfile->created_at = now();
            $newProfile->updated_at = now();
            $newProfile->save();
        }

        // Send success message
        session()->flash('membershipInfo', 'Your profile has been updated.');

        // Processing finished, return to Referral Request form
        return redirect()->route('profile.view');
    }
}

