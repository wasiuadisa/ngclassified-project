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
            @if( session('infoMessage') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> {{ session('infoMessage') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

<?php //Drop the session messages
session()->forget('infoMessage'); ?>

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

            <form method="POST" action="{{ route('existing_post.upload', [$post->id]) }}">
                @csrf
                <!-- Beginning of class="col-lg-12" -->
                <div class="col-lg-12">

                    <!-- Beginning of class="card" -->
                    <div class="card">                    
                        <div class="card-header">
                            <h3>{{ ucwords($pageTitle) }}</h3>
                        </div>

                        <!-- Beginning of title -->
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Title
                                    </div>
                                    <input type="text" id="title" name="title" value="@if(count($errors) > 0){{ old('title') }}@else{{ filter_var($post->title, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!-- End of title -->

                        <!-- Beginning of description -->
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Description
                                    </div>
                                    <textarea name="description" id="description" rows="3" class="form-control">@if(count($errors) > 0){{ old('description') }}@else{{ filter_var($post->description, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- End of description -->

                        <!-- Beginning of Category -->
                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Category
                                    </div>
                                    <select id="category" class="form-control" name="category" required>
                                    @if( count($errors) > 0 )
                                        <option value="{{ old('category') }}" selected>{{ (new \App\Logic\Posts)->getCategoryName(old('category')) }}</option>
                                    @else
                                        <option value="{{ $post->mallcategories_id }}" selected>{{ (new \App\Logic\Posts)->getCategoryName($post->mallcategories_id) }}</option>
                                    @endif
                                        <option value="">-- Select category --</option>
<?php $categories = (new \App\Logic\Posts)->listCategories(); ?>
                                        @foreach( $categories as $category )<option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- End of Category -->

                                <!-- Beginning of Price -->
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Price
                                    </div>
                                    <input id="price" type="text" class="form-control" name="price" value="@if(count($errors) > 0){{ old('price') }}@else{{ filter_var($post->price, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif">
                                </div>
                            </div>
                        </div>
                        <!-- End of Category, Price -->

                        <!-- Beginning of Age, Condition -->
                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                
                                <div class="input-group col-lg-6 col-md-4">
                                    <div class="input-group-addon">
                                        Age
                                    </div>
                                    <input type="text" id="age" name="age" value="@if(count($errors) > 0){{ old('age') }}@else{{ filter_var($post->age, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif" class="form-control" required>
                                </div>
                                
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Condition
                                    </div>
                                    <select id="condition" class="form-control" name="condition" required>
                                    @if( count($errors) > 0 )
                                        <option value="{{ old('condition') }}" selected>{{ ucfirst(old('condition')) }}</option>
                                    @else
                                        <option value="{{ $post->condition }}">{{ ucfirst($post->condition) }}</option>
                                    @endif
                                        <option value=""> Used or New </option>
                                        <option value="used">Used</option>
                                        <option value="new">New</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End of Age, Condition -->

                        <!-- Beginning of State, City -->
                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-7 col-md-7">
                                    <div class="input-group-addon">
                                        State
                                    </div>
                                    <input type="text" id="state" class="form-control" name="state" value="@if(count($errors) > 0){{ old('state') }}@else{{ filter_var($post->state, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif">
                                </div>

                                <!-- Beginning of City -->
                                <div class="input-group col-lg-5 col-md-5">
                                    <div class="input-group-addon">
                                        City
                                    </div>
                                    <input type="text" id="city" name="city" value="@if(count($errors) > 0){{ old('city') }}@else{{ filter_var($post->city, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-12"><h3>Contact Details</h3></div>
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Name
                                    </div>
                                    <input name="name" id="name" type="text" class="form-control" value="@if(count($errors) > 0){{ old('name') }}@else{{ filter_var($post->contact_name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif" />
                                </div>

                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Address
                                    </div>
                                    <textarea name="address" id="address" rows="4" class="form-control">@if(count($errors) > 0){{ old('address') }}@else{{ filter_var($post->contact_address, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group col-lg-8 col-md-8">
                                    <div class="input-group-addon">
                                        E-mail address
                                    </div>
                                    <input id="email" type="text" class="form-control" name="email" value="@if(count($errors) > 0){{ old('email') }}@else{{ filter_var($post->contact_email, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif">
                                </div>

                                <div class="input-group col-lg-4 col-md-4">
                                    <div class="input-group-addon">
                                        Phone
                                    </div>
                                    <input id="phone" type="text" class="form-control" name="phone" value="@if(count($errors) > 0){{ old('phone') }}@else{{ filter_var($post->contact_phone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) }}@endif">
                                </div>
                            </div>
                        </div>

                        <!-- Post post ID -->
                        <input type="hidden" name="postID" value="{{ $post->id }}">

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="submit" name="submit"  class="btn btn-lg btn-primary">
                                        {{ __('Update Post') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
@endsection