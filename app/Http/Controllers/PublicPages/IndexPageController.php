<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Get list of recent listings
        $recentListings = (new \App\Logic\Posts)->listRecentPosts(16);

        // Get list of popular listings
        $popularListings = (new \App\Logic\Posts)->listPopularPosts(16);

        // Get list of categroies
        $categories = (new \App\Logic\Posts)->listCategories();

        return view('public.index', [
            'categories' => $categories,
            'recentListings' => $recentListings,
            'popularListings' => $popularListings,
        ]);
    }
}
