<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecentPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get list
        $listings = (new \App\Logic\Posts)->listRecentPosts(26);
        $pageTitle = 'Recent posts';

        return view('public.list', [
            'listings' => $listings,
            'pageTitle' => $pageTitle,
        ]);
    }
}
