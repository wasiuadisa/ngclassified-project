<?php

namespace App\Logic;

// Import model classes
use App\Models\Mallpost;
use App\Models\Mallcategory;
use App\Models\Mallimage;

use Illuminate\Support\Facades\DB;

class Posts
{
   /**
     * Get list of posts that match search of a particular category
     */
    public function postSearch($search_string, $categoryName, $length)
    {
        if($categoryName == "all")
        {
            $posts = DB::table('mallposts')
               ->whereFullText('title', $search_string)
               ->whereFullText('description', $search_string)
               ->orderBy('updated_at', 'desc')
               ->paginate($length);
        }
        else {
            $categoryID = Mallcategory::where([
                ['block', 0], ['name', "$categoryName"]
            ])->value('id');

            $posts = DB::table('mallposts')
               ->whereFullText('title', $search_string)
               ->whereFullText('description', $search_string)
               ->where('mallcategories_id', $categoryID)
               ->orderBy('updated_at', 'desc')
               ->paginate($length);
        }

        return $posts;
    }

   /**
     * Get list of posts of a particular category
     */
    public function categoryListByName($categoryName, $length)
    {
        $categoryId = Mallcategory::where([
            ['block', 0], ['name', "$categoryName"]
        ])->value('id');

        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['mallcategories_id', $categoryId]
        ])->orderBy('created_at', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get list of member's posts, of a particular category
     */
    public function memberCategoryListByName($categoryName, $length, $user_id)
    {
        $categoryId = Mallcategory::where([
            ['block', 0], ['name', "$categoryName"]
        ])->value('id');

        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['mallcategories_id', $categoryId], ['users_id', $user_id]
        ])->orderBy('created_at', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get full data of a post, given the title and corresponding ID
     */
    public function pageByIdAndTitle($replaced_title, $id)
    {
        // 
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['id', $id], ['title', $replaced_title],
	    ])->first();

        return $posts;
    }

   /**
     * Get list of recently posted listings
     */
    public function listRecentPosts($length)
    {
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0],
        ])->orderBy('created_at', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get list of popular listings
     */
    public function listPopularPosts($length)
    {
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0],
        ])->orderBy('views', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get list of categories
     */
    public function listCategories()
    {
        return Mallcategory::where([
            ['block', 0],
//        ])->orderBy('name', 'asc');
        ])->get();
    }

   /**
     * Get category name
     */
    public function getCategoryName($category_id)
    {
        $name = Mallcategory::where([
            ['block', 0], ['id', $category_id]
        ])->value('name');

        return $name;
    }

    /* Get the first image for the post */
    public function getFirstImageFilename($id)
    {
        $filename = Mallimage::where([
            /*['blocked', 0], ['deleted', 0],*/ ['mallposts_id', $id],
        ])->orderBy('id', 'ASC')->first();

        return $filename->filename;
    }

   /**
     * Get the list of member's posts
     */
    public function allPostsOfAMember($user_id, $length)
    {
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['users_id', $user_id],
        ])->orderBy('created_at', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get the list of member's recent posts
     */
    public function allRecentPostsOfAMember($user_id, $length)
    {
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['users_id', $user_id],
        ])->orderBy('created_at', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get the list of member's popular posts
     */
    public function allPopularPostsOfAMember($user_id, $length)
    {
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['users_id', $user_id],
        ])->orderBy('views', 'desc')->paginate($length);

        return $posts;
    }

   /**
     * Get full data of a post, given the title and corresponding ID
     */
    public function memberPageViewById($user_id, $id)
    {
        // 
        $posts = Mallpost::where([
            ['blocked', 0], ['deleted', 0], ['id', $id], ['users_id', $user_id],
        ])->first();

        return $posts;
    }

   /**
     * Update post's photo name using postID and photo name
     */
    public function updateOnlyPostPhotoFileName($postID, $fileName)
    {
        return Mallpost::where([
            ['id', $postID],
        ])->update([
            'filename' => $fileName
        ]);
    }

   /**
     * Delete post by using postID
     */
    public function deletePost($postID)
    {
        return Mallpost::where([
            ['id', $postID],
        ])->delete();
    }
}
