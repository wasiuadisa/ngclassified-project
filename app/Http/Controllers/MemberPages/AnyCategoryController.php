<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

class AnyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function anyCategoryPosts(Request $request, $categoryName, $length)
    {
        // Get list of categories
        $posts = (new \App\Logic\Posts)->memberCategoryListByName($categoryName, $length, Auth::user()->id);

        $pageTitle = ucfirst($categoryName) . ' category';

        return view('member.my_posts', [
            'posts' => $posts,
            'pageTitle' => $pageTitle,
        ]);
    }
}
