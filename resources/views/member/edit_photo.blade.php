@section('pageTitle') {{ $pageTitle }} |  @endsection

@extends('layouts.template_member')

@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                            <li class="active">Photo Editing: {{ $pageTitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->
            @if( session('infoMessage') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> {{ session('infoMessage') }} {{ session('infoMessage') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

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

            <form method="post" action="{{ route('post_photo.edit_upload', $postID) }}" enctype="multipart/form-data">
            @csrf
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h3>Photo Editing for: {{ ucwords($pageTitle) }}</h3>
                        </div>
                    @if( session('infoCondition') !== '' || session('info') !== '' )
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                      <a href="{{ route('post.view', [$postID,]) }}" style="color: black;">
                                          Are you done? View this post
                                      </a>
                                    </div>
                                </div>
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        <a href="{{ route('post.all') }}" style="color: black;">
                                            All posts
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Photo
                                    </div>
                                    <input type="file" id="photo" name="photo" value="{{ old('photo') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="hidden" name="postID" value="{{ $postID }}">
                                    <button type="submit" name="submit"  class="btn btn-lg btn-primary">
                                        {{ __('Upload photo') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

{{ session()->forget('infoCondition') }}
{{ session()->forget('infoMessage') }}
{{ session()->forget('info') }}
@endsection
