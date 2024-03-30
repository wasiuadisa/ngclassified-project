<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Sanitize the search input value
        $cleaned_search_input_title = htmlspecialchars($request->input('search'));
        $cleaned_search_input_category = htmlspecialchars($request->input('category'));

        // Search the database for the given input
        $listings = (new \App\Logic\Posts)->postSearch($cleaned_search_input_title, $cleaned_search_input_category, 26);

        // Set page title 
        $pageTitle = 'Search for ' . $cleaned_search_input_title;

        return view('public.list', [
            'listings' => $listings,
            'pageTitle' => $pageTitle,
        ]);
    }
}
