<?php

namespace App\Http\Controllers\MemberPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import request classes for validation
use App\Http\Requests\Memberpages\NewPostFormRequest;
use App\Http\Requests\Memberpages\NewPhotoFormRequest;

// Import models
use App\Models\Mallpost;

// Import class for using Authentication
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class ExistingPostController extends Controller
{
    /**
     * Display editing form.
     */
    public function existingPostForm($postID)
    {
        /* If the post editing form is called, the post should exist. Just to be sure, check that the post exists. */
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $postID);

        // This is the previous URL. 
        $previous_URL = url()->previous();

        return view('member.edit_post', [
            'post' => $post,
            'postID' => $postID,
            'pageTitle' => $post->title,
            'previous_UR
            L' => $previous_URL,
        ]);
    }

    /**
     * Process the form data for editing a post data.
     *
     * @param  int  $postID
     * @return \Illuminate\Http\Response
     */
    public function formDataPost(NewPostFormRequest $request, $postID)
    {
        // First of all, confirm the post intended for editing exists.
        $postExists = Mallpost::where('id', $request->input('postID'))->count();

        // In case the post doesn't exist delete all session data for this user and send him to the login page to get back in.
        if($postExists == 0)
        {
            // Delete all session data
            $request->session()->flush();

            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site!');

            // Redirect the User to the Login page
            return redirect()->route('login');
        }

        // Sanitize the request title first
        $clean_title = htmlspecialchars($request->input('title'), ENT_QUOTES);

        // Process variables for updating
        $dataForPostTable = array(
            //Sanitize inputs where necessary before saving to database
            /**** Leave the following values as they are *****/
 
            ////////////////////////////////////////
            /// Clean up variables for database ///
            //////////////////////////////////////
            'mallcategories_id' => htmlspecialchars($request->input('category'), ENT_SUBSTITUTE),
            'title' => htmlspecialchars($request->input('title'), ENT_SUBSTITUTE),
            'description' => htmlspecialchars($request->input('description'), ENT_SUBSTITUTE),
            'price' => htmlspecialchars($request->input('price'), ENT_SUBSTITUTE),
            'age' => htmlspecialchars($request->input('age'), ENT_SUBSTITUTE),
            'condition' => htmlspecialchars($request->input('condition'), ENT_SUBSTITUTE),
            'state' => htmlspecialchars($request->input('state'), ENT_SUBSTITUTE),
            'city' => htmlspecialchars($request->input('city'), ENT_SUBSTITUTE),
            'url_slug' => htmlspecialchars(Str::slug($clean_title, '-'), ENT_SUBSTITUTE),
            'contact_name' => htmlspecialchars($request->input('name'), ENT_SUBSTITUTE),
            'contact_address' => htmlspecialchars($request->input('address'), ENT_SUBSTITUTE),
            'contact_phone' => htmlspecialchars($request->input('phone'), ENT_SUBSTITUTE),
            'contact_email' => htmlspecialchars($request->input('email'), ENT_SUBSTITUTE),
            'updated_at' => now()
        );

        Mallpost::where('id', $request->input('postID'))
            ->update($dataForPostTable);

        session()->flash('info', 'Good job! The post has been updated, successfully.');

        //Redirect to a route's name
        return redirect()->route('post.view', [ $request->input('postID'), ]);
    }

    /**
     * Delete the post photo with given ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postPhotoDelete(Request $request, $id)
    {
        // Set form inputs as variable.
        $postID     = $id;

        // Check that such post id exists
        if($postID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'No such post photo exists.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Get the post photo filename from the database
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $id);

        // Check that such post exists for the member
        if($post == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'No such post exists.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        /* Set the path to the files directory and include the file name */
        $pathToFile = public_path('image/' . $post->filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToFile);

        // Save new post photo file name as the default in database 
        (new \App\Logic\Posts)->updateOnlyPostPhotoFileName($postID, config('app.default_image'));

        // Create flash message
        session()->flash('info', 'The post\'s photo has been deleted, successfully. You now have the default image');

        //Redirect to a route's name
        return redirect()->route('post.view', $id);
    }

    /**
     * Delete the post photo with given ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request, $id)
    {
        // Set form inputs as variable.
        $postID     = $id;

        // Check that such post id exists
        if($postID == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'No such post photo exists.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Check that the post exists in the database
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $id);

        // Check that such post exists for the member
        if($post == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'No such post exists.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        /* Set the path to the files directory and include the file name */
        $pathToFile = public_path('image/' . $post->filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToFile);

        // Delete the post from the database 
        (new \App\Logic\Posts)->deletePost($postID);

        // Create flash message
        session()->flash('info', 'The post has been deleted, successfully.');

        //Redirect to a route's name
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing a post photo.
     *
     * @param  int  $postID
     * @return \Illuminate\Http\Response
     */
    public function postPhotoEditForm(Request $request, $postID)
    {
        /* If the post photo editing form is called, the photo should exist. Just to be sure, check that the photo exists. Get photo's filename */
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $postID);

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($post->filename == '')
        {
            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site! Follow the links as provided by the application.');

            // Redirect the User to the Login page
            return redirect()->route('dashboard');
        }

        // This is the previous URL. 
        $previous_URL = url()->previous();

        return view('member.edit_photo', [
            'postID' => intval($postID),
            'pageTitle' => $post->title,
            'previous_URL' => $previous_URL,
        ]);
    }

    /**
     * Update the post photo file name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postID
     * @return \Illuminate\Http\Response
     */
    public function formDataPostPhotoEdit(NewPhotoFormRequest $request)
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

        /* If the post photo editing form is called, the post photo should exist. Just to be sure, check that the post photo exists. Get post's photo filename */
        // Get the post photo filename from the database
        $post = (new \App\Logic\Posts)->memberPageViewById(Auth::user()->id, $postID);

        // Check that such post exists
        if($post == '')
        {
            // Flash this message. Note, it'll appear once only.
            session()->flash('membershipInfo', 'Nice try! The post you want to upload a photo for, doesn\'t exist. Stop trying to hack this website.');

            //Redirect to previous URL
            return redirect()->route('dashboard');
        }

        // Check that the image exists. Otherwise redirect to the Dashboard page with a warning.
        if($post->filename == '')
        {
            // Set a message to flash at the User
            session()->flash('membershipInfo', 'Stop trying to hack this site! Follow the links as provided by the application.');

            // Redirect the User to the Login page
            return redirect()->route('dashboard');
        }

        /*************************************************************/
        /* First create a NEW filename for this uploaded photo */
        // Assign a new variable name to the photo
        $image = $postPhoto; //This will have filename and its extension

        // Hash the file name for the uploaded photo.
        $hashedName = hash('ripemd160', time()).'.'.$image->getClientOriginalExtension();

        // Set the destination path
        $destinationPath = public_path('image/');

        /*************************************************************/
        /* Delete the existing photo file from the directory */
        /* Set the path to the files directory and include the file name */
        $pathToImageFile = public_path('image/' . $post->filename);

        /* Delete the file using Laravel's file handling method for deleting files */
        unlink($pathToImageFile);

        /*************************************************************/
        // Move the NEWLY uploaded and renamed photo to destination folder
        $image->move($destinationPath, $hashedName);

        // Save new post photo file name in database 
        (new \App\Logic\Posts)->updateOnlyPostPhotoFileName($postID, $hashedName);

        // Create flash message
        session()->flash('info', 'The post has been updated, successfully, with the new photo.');

        //Redirect to a route's name
        return redirect()->route('post.view', [ $postID ]);
    }
}
