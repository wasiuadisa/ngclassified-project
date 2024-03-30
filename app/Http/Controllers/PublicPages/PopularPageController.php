<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PopularPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get list
        $listings = (new \App\Logic\Posts)->listPopularPosts(26);
        $pageTitle = 'Popular posts';

        return view('public.list', [
            'listings' => $listings,
            'pageTitle' => $pageTitle,
        ]);
    }
}
