<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $categoryName, $length)
    {
        // Get list of categories
        $listings = (new \App\Logic\Posts)->categoryListByName($categoryName, $length);

        $pageTitle = ucfirst($categoryName) . ' category';

        return view('public.list', [
            'listings' => $listings,
            'pageTitle' => $pageTitle,
        ]);
    }
}
