<?php

namespace App\Logic;

// Import model classes
use App\Models\Profile;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class MemberProfiles
{
   /**
     * Get profile of member with given ID, from User table
     */
    public function memberProfileUserTable($memberID)
  	{
/*      User::where([
        ['deactivated', 0], ['suspended', 0], ['banned', 0], ['id', Auth::user()->id]
      ])->first();
*/
  		$member = User::where('id', $memberID)->first();
          return $member;
  	}

   /**
     * Get profile of member with given ID, from Profile tale
     */
    public function memberProfileProfileTable($memberID)
  	{
/*      Profile::where([
        ['users_id', Auth::user()->id]
      ])->first();
*/
  		$member = Profile::where('users_id', $memberID)->first();
          return $member;
  	}

   /**
     * Increase view count of a user profile using given memberID
     */
    public function increaseViewCountForMemberProfile($memberID)
    {
      Profile::where('users_id', $memberID)->increment('view_count');
    }
}
