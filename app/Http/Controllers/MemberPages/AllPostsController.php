<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

class AllPostsController extends Controller
{
    /**
     * Display a list of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function allPosts()
    {
        // Get the list of member's posts
        $posts = (new \App\Logic\Posts)->allPostsOfAMember(Auth::user()->id, config('app.list_length'));

        // Set page
        $pageTitle = 'All my posts';

        return view('member.my_posts', [
            'posts' => $posts,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Display a list of recent posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function allRecentPosts()
    {
        // Get the list of recent member's posts
        $posts = (new \App\Logic\Posts)->allRecentPostsOfAMember(Auth::user()->id, config('app.list_length'));

        // Set page
        $pageTitle = 'My recent posts';

        return view('member.my_posts', [
            'posts' => $posts,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Display a list of popular posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function allPopularPosts()
    {
        // Get the list of member's posts
        $posts = (new \App\Logic\Posts)->allPopularPostsOfAMember(Auth::user()->id, config('app.list_length'));

        // Set page
        $pageTitle = 'My popular posts';

        return view('member.my_posts', [
            'posts' => $posts,
            'pageTitle' => $pageTitle,
        ]);
    }

    /**
     * Display post of given ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postView($id)
    {
        // Get the full data for a member's post with given ID
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $id);

        // Display view page
//        return redirect()->route('movie_view', [
        return view('member.post_view', [
            'post' => $post,
        ]);
    }
}
