<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicPages\IndexPageController;
use App\Http\Controllers\PublicPages\SearchPageController;
use App\Http\Controllers\PublicPages\RecentPageController;
use App\Http\Controllers\PublicPages\PopularPageController;
use App\Http\Controllers\PublicPages\ViewPageController;
use App\Http\Controllers\PublicPages\CategoryPageController;

use App\Http\Controllers\MemberPages\NewPostController;
use App\Http\Controllers\MemberPages\ExistingPostController;
use App\Http\Controllers\MemberPages\AllPostsController;
use App\Http\Controllers\MemberPages\AnyCategoryController;
use App\Http\Controllers\MemberPages\MemberProfileController;
use App\Http\Controllers\MemberPages\MemberDashboardController;

###########################################################
#################### PUBLIC ROUTES ########################
###########################################################

Route::get('/', IndexPageController::class)->name('index');

Route::get('/search', SearchPageController::class)->name('search_page');

Route::get('/recent', RecentPageController::class)->name('recent');

Route::get('/popular', PopularPageController::class)->name('popular');

Route::get('/view/{title_slug}/{id}', ViewPageController::class)->name('view');

Route::get('/category/{categoryName}/{length}', CategoryPageController::class)->name('category');

###########################################################
#################### MEMBER ROUTES ########################
###########################################################

require __DIR__.'/auth.php';

// Permanently redirect to the member's dashboard
//Route::permanentRedirect('/dashboard', '/member/dashboard');
Route::redirect('/member/dashboard', '/dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

###########################################################
#################### CREATED MEMBER ROUTES ################
###########################################################

    // User's custom dashboard page
    Route::get('/member/dashboard', MemberDashboardController::class)->name('profile.dashboard');

    // Other member's profile page
    Route::get('/profile_view/{memberID}', [MemberProfileController::class, 'memberProfileView'])->name('profile.member_view');

    // Profile page
    Route::get('/profile_view', [MemberProfileController::class, 'profileView'])->name('profile.view');

    // Profile edit form
    Route::get('/profile_edit', [MemberProfileController::class, 'profileEdit'])->name('profile.edit');

    // Profile edit data updating
    Route::post('/profile_edit', [MemberProfileController::class, 'profileEditProcessing'])->name('profile.update');

    // Profile question and answer form
    Route::get('/profile_question_and_answer', [MemberProfileController::class, 'profileQuestionAndAnswerForm'])->name('profile.question_and_answer');

    // Profile question and answer form
    Route::post('/profile_question_and_answer', [MemberProfileController::class, 'profileQuestionAndAnswerProcessing'])->name('profile.question_and_answer_posting');

    // Profile deactivation
    Route::get('/profile_deactivate', [MemberProfileController::class, 'profileDeactivation'])->name('profile.deactivation');

    // Form for new post
    Route::get('/new_post', [NewPostController::class, 'postForm'])->name('new_post.form');

    // New post form data posting
    Route::post('/new_post', [NewPostController::class, 'formDataPost'])->name('new_post.upload');

    // Form for editing existing post
    Route::get('/post/{id}', [ExistingPostController::class, 'existingPostForm'])->name('existing_post.form');

    // Existing post form data posting
    Route::post('/post/{id}', [ExistingPostController::class, 'formDataPost'])->name('existing_post.upload');

    // Form for creating new post photo
    Route::get('/post/{id}/photo', [NewPostController::class, 'postImageForm'])->name('post_photo.form');

    // New post photo form data posting
    Route::post('/post/{id}/photo', [NewPostController::class, 'formDataPostPhoto'])->name('post_photo.upload');

    // Form for editing existing post photo
    Route::get('/post/{id}/photo/edit', [ExistingPostController::class, 'postPhotoEditForm'])->name('post_photo.edit_form');

    // Existing post photo form data posting
    Route::post('/post/{id}/photo/edit', [ExistingPostController::class, 'formDataPostPhotoEdit'])->name('post_photo.edit_upload');

    // Existing post delete
    Route::get('/post/{id}/delete', [ExistingPostController::class, 'postDelete'])->name('existing_post.delete');

    // Existing post photo delete
    Route::get('/post/{id}/photo/delete', [ExistingPostController::class, 'postPhotoDelete'])->name('existing_post_photo.delete');

    // List all posts created by the member
    Route::get('/my_posts', [AllPostsController::class, 'allPosts'])->name('post.all');

    // List all posts recently created by the member
    Route::get('/my_posts/recent', [AllPostsController::class, 'allRecentPosts'])->name('post.recent');

    // List all popular posts created by the member
    Route::get('/my_posts/popular', [AllPostsController::class, 'allPopularPosts'])->name('post.popular');

    // List all posts created by the member for a particular category
    Route::get('/my_posts/category/{categoryName}/{length}', [AnyCategoryController::class, 'anyCategoryPosts'])->name('post.category');

    // View a post created by the member
    Route::get('/my_post/{id}', [AllPostsController::class, 'postView'])->name('post.view');
});