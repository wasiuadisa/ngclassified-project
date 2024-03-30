<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import request classes for validation
use App\Http\Requests\MemberPages\NewPostFormRequest;
use App\Http\Requests\MemberPages\NewPhotoFormRequest;

// Import models
use App\Models\Mallpost;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class NewPostController extends Controller
{
    /**
     * Display form for new post.
     */
    public function postForm()
    {
        $pageTitle = "New post ";
        $pageTag = ", new-post";

        // Display acquired data on page
        return view('member.new_post', [
            'pageTag' => $pageTag,
            'pageTitle' => $pageTitle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formDataPost(NewPostFormRequest $request)
    {
        // Sanitize the request title first
        $clean_title = htmlspecialchars($request->input('title'), ENT_QUOTES);
        
        //Instanstiate post input class model
        $newpost               = new Mallpost;
 
        // Sanitize inputs
        $newpost->deleted         = 0;
        $newpost->blocked         = 0;
        $newpost->mallcategories_id   = filter_var($request->input('category'), FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH);
        $newpost->users_id        = Auth::user()->id;
        $newpost->title         = htmlspecialchars($request->input('title'), ENT_SUBSTITUTE);
        $newpost->description        = htmlspecialchars($request->input('description'), ENT_SUBSTITUTE);
        $newpost->condition      = htmlspecialchars($request->input('condition'), ENT_SUBSTITUTE);
        $newpost->price      = htmlspecialchars($request->input('price'), ENT_SUBSTITUTE);
        $newpost->age      = htmlspecialchars($request->input('age'), ENT_SUBSTITUTE);
        $newpost->state      = htmlspecialchars($request->input('state'), ENT_SUBSTITUTE);
        $newpost->city      = htmlspecialchars($request->input('city'), ENT_SUBSTITUTE);
        $newpost->contact_name      = htmlspecialchars($request->input('name'), ENT_SUBSTITUTE);
        $newpost->contact_address  = htmlspecialchars($request->input('address'), ENT_SUBSTITUTE);
        $newpost->contact_phone      = htmlspecialchars($request->input('phone'), ENT_SUBSTITUTE);
        $newpost->contact_email      = htmlspecialchars($request->input('email'), ENT_SUBSTITUTE);
        $newpost->url_slug         = Str::slug($clean_title, '-');
        $newpost->filename       = 'zero-image.png';
        $newpost->created_at       = now();
        $newpost->updated_at       = now();
        $newpost->save();

        session()->flash('info', 'Good Job! Your new ad has been created, successfully.');

        //Redirect to a route's name
        return redirect()->route('post.view', [ $newpost->id, ]);
    }

    /**
     * Show the form for creating a new post image.
     *
     * @return \Illuminate\Http\Response
     */
    public function postImageForm($id)
    {
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $id);

        return view('member.new_photo', [
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created post photo in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formDataPostPhoto(NewPhotoFormRequest $request)
    {
        // Set form inputs as variable.
        $postID        = intval($request->input('postID'));
        $postPhoto     = $request->file('photo');

        // Check that such post exists
        if($postID == '' || $postPhoto == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'Nice try! The post ID and its photo don\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

         /* Get post's full details */
        $postData = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $postID);

        // Check that such post exists
        if($postData == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'Nice try! The movie you want to upload a photo for, doesn\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Assign a new variable name to the photo
        $image = $postPhoto; //This will have filename and its extension

        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path
        $destinationPath = public_path('image/');

        // Move the uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        // Save new post photo file name in database 
        (new \App\Logic\Posts)->updateOnlyPostPhotoFileName($postID, $hashedName);

        // Create flash message
        session()->flash('info', 'Your new post photo has been saved, successfully.');

        //Redirect to a route's name
        return redirect()->route('post.view', [ $postID ]);
    }
}
