<?php    $pageTitle = $post->title; ?>

@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
    <style type="text/css">
        .need-space .input-group {
            margin-bottom: 20px;
        }
    </style>
@endsection

@extends('layouts.template_member')

@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('dashboard') }}" class="btn btn-secondary"> Take me to Dashboard </a></li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('dashboard') }}"> Dashboard </a></li>
                            <li class="active"><a href="#{{-- route('dashboard') --}}">{{ $pageTitle }}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->
            @if( session('info') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> {{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

<?php //Drop the session messages
session()->forget('info'); ?>

            @if( count($errors) > 0 )
            <!-- Errors message -->
            <div class="col-sm-12">
                <ul class="alert alert-danger list list-unstyled text-center">
                @foreach( $errors->all() as $error )                                
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                <hr>
            </div>
            @endif

            <div class="col-lg-12">

                <!-- Beginning of Cards -->
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <h3 class="card-title mb-3" class="text-center">{{ $pageTitle }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Beginning of Main content -->
                <div class="row">

                    <div class="card col-md-12">
                        <div class="card-body">
                            <h4 class="card-title mb-3" class="text-center"><b>URL slug:</b> {{ $post->url_slug }}</h4>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
<?php if($post->filename == ''){ ?>
                            <img class="card-img-top" src="{{ asset('image/zero-image.png') }}" alt="No post photo">
<?php }else{ ?>
                            <img class="card-img-top" src="{{ asset('image/' . $post->filename) }}" alt="{{ $post->title }}">
<?php } ?>
                            <div class="card-body" style="color: black;">
                                {{ htmlspecialchars_decode($post->description) }}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>General info</h4>
                            </div>

                            <div class="card-body">
                                <div class="default-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color: black;">Post details</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: black;">Contact details</a>
                                        </div>
                                    </nav>

                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Posted on:</b> 
                                                </div>
                                                <div class="col-md-9">
    <?php $modified_date = date_create_from_format('Y-m-d H:i:s', "$post->created_at");
        $posted_on_date = date_format($modified_date, 'M d, Y. g:i A'); ?>
                                                    {{ $posted_on_date }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Updated on:</b> 
                                                </div>
                                                <div class="col-md-9">
    <?php $modified_date = date_create_from_format('Y-m-d H:i:s', "$post->updated_at");
        $updated_on_date = date_format($modified_date, 'M d, Y. g:i A'); ?>
                                                    {{ $updated_on_date }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <i class="fa fa-tv"></i> <b>Category:</b>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ (new \App\Logic\Posts)->getCategoryName($post->mallcategories_id) }}
                                                </div>
                                            </div>@if($post->price != '')
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Price:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    ₦{{ number_format($post->price) }}
                                                </div>
                                            </div>@endif
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Age:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->age }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Condition:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->condition }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Page Views:</b>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->views }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>State:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->state }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>City:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->city }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Contact name:</b> 
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->contact_name }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Contact address:</b>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->contact_address }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Contact phone:</b>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->contact_phone }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                   <i class="fa fa-tv"></i> <b>Contact email:</b>
                                                </div>
                                                <div class="col-md-9">
                                                    {{ $post->contact_email }}
                                                </div>
                                            </div>
                                        </div>
<!-------------------------------------------------------->
                                    </div>

                                </div>
                            </div>
<?php /**/ ?>
                        </div>
                        <!-- /# column -->
                    </div><?php /**/ ?>
<!-------------------------------------------------------->
                    <div class="col-md-3">
                        <!-- Beginning of Modals -->
              <?php if($post->filename == 'zero-image.png' || $post->filename == 'default.png'){ ?>
                        <div class="card">
                            <div class="card-header">
                                <i class="mr-2 fa fa-align-justify"></i>
                                <strong class="card-title" v-if="headerText">No post photo</strong>
                            </div>
                        
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <a class="btn btn-lg btn-secondary" href="{{ route('post_photo.form', $post->id) }}">{{ 'Upload a photo' }}</a>
                                </div>
                            </div>
                        </div>
              <?php }else{ ?>
                        <div class="card">
                            <div class="card-header">
                                <i class="mr-2 fa fa-align-justify"></i>
                                <strong class="card-title" v-if="headerText">
                                    {{ $post->title }}
                                </strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="mx-auto d-block img-fluid img-thumbnail" src="{{ URL::asset('image/' . $post->filename) }}" alt="{{ $post->title }}" style="width:100%">
                                    <!-- Trigger button for enlargement modal -->
                                    <button type="button" class="btn btn-lg btn-success mb-1" data-toggle="modal" data-target="#Modal{{ $post->id }}" style="margin-bottom: 15px;">
                                        Enlarge
                                    </button>
                                    <a href="{{ route('post_photo.edit_form', [$post->id]) }}" class="btn btn-lg btn-primary mb-1" style="margin-bottom: 15px;">
                                        Change photo
                                    </a>
                                    <!-- Trigger button for delete modal -->
                                    <button type="button" class="btn btn-lg btn-danger mb-1" data-toggle="modal" data-target="#DeletingPhoto{{ $post->id }}">
                                        Delete this photo
                                    </button>

                                    <a href="{{ route('existing_post.form', [$post->id]) }}" class="btn btn-lg btn-secondary mb-1" style="margin-bottom: 15px;">
                                        Edit this post
                                    </a>
                                    <!-- Trigger button for delete modal -->
                                    <button type="button" class="btn btn-lg btn-danger mb-1" data-toggle="modal" data-target="#DeletingPost">
                                        Delete post & photo
                                    </button>
                                </div>
                            </div>
              <?php } ?>
                        </div>
                    </div>
 
              <?php if($post->filename !== 'default.png' || $post->filename !== 'zero-image.png'){ ?>
<!------------- Beginning of photo enlargement modal --------------->
            <div class="modal fade" id="Modal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="Modal{{ $post->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img class="card-img-top img-fluid img-thumbnail" src="{{ asset('image/' . $post->filename) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                  
                    </div>
                </div>
            </div>
<!------------- End of photo enlargement modal --------------->

<!------------- Beginning of photo deletion modal --------------->
            <div class="modal fade" id="DeletingPhoto{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="DeletingPhoto{{ $post->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="{{ $post->id }}ModalLabel">Are you sure you want to delete this photo?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img class="card-img-top img-fluid img-thumbnail" src="{{ asset('image/' . $post->filename) }}" alt="{{ $post->title }}">
                        </div>

                        <div class="modal-body">
                            <!-- Trigger button for changing photo and caption modal -->
                            <div class="col-md-6" style="margin-bottom: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    No.
                                </button>
                            </div>
                            <!-- Trigger button for deleting modal -->
                            <div class="col-md-6">
                                <a href="{{ route('existing_post_photo.delete', [$post->id]) }}" class="btn btn-danger">
                                    Yes, Delete the photo.
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>                  
                    </div>
                </div>
            </div>
<!------------- End of photo deletion modal --------------->
              <?php } ?>
<!------------- Beginning of deleting all post resources modal --------------->
            <div class="modal fade" id="DeletingPost" tabindex="-1" role="dialog" aria-labelledby="DeletingPostLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Are you sure you want to delete this post and its photo?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Trigger button for changing photo and caption modal -->
                            <div class="col-md-6" style="margin-bottom: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    No.
                                </button>
                            </div>
                            <!-- Trigger button for deleting modal -->
                            <div class="col-md-6">
                                <a href="{{ route('existing_post.delete', [$post->id]) }}" class="btn btn-danger">
                                    Yes. Delete this post & photo.
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>                  
                    </div>
                </div>
            </div>
<!------------- End of deleting all post resources modal --------------->

@endsection
