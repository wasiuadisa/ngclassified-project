<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ViewPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $title_slug, $id)
    {
        // Remove slug hyphen
        $replaced_title = Str::replace('-', ' ', $title_slug);

        $post = (new \App\Logic\Posts)->pageByIdAndTitle($replaced_title, $id);

        $pageTitle = $replaced_title;

        return view('public.view-page', [
            'post' => $post,
            'pageTitle' => $pageTitle,
        ]);
    }
}
