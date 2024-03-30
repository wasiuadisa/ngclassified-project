<?php //$pageTitle = "Edit My Profile"; ?>

@section('pageTitle') {{ $pageTitle }} | @endsection

@section('extra_script') <style>
    .breadcrumbLink {
        color: black; 
    }
</style>
@endsection

@extends('layouts.template_member')

@section('content')
        <div class="breadcrumbs">

            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ $pageTitle }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a class="breadcrumbLink" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a class="breadcrumbLink" href="{{ route('profile.view') }}">My Profile</a></li>
                            <li class="active"><a class="breadcrumbLink" href="{{ route('profile.edit', Auth::user()->id) }}">Edit My Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of class="breadcrumbs" -->

        <div class="content mt-3">
        <!------------------>
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-danger">Warning</span> <br>Changes to your Profile is irreversible.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @if( session('membershipInfo') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> <br>{{ session('membershipInfo') }}
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

                <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <div class="input-group">
                                        <img data-toggle="modal" data-target="#exampleModal1" src="{{ asset('profile/' . $user_user->profileimage) }}" id="frontal" class="img-responsive" name="{{ $user_user->firstname }}'s photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="profilePhoto" type="file" class="form-control" name="profilePhoto" value="@if(count($errors) > 0){{ old('profilePhoto') }}@else{{ filter_var($user_user->profileimage, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">My Profile Info</div>
                            <div class="card-body card-block">
                                <?php /*
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Username
                                        </div>
                                        <input type="text" id="username" name="username" value="@if(count($errors) > 0){{ old('username') }}@else{{ filter_var($user_user->username, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
*/ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Username
                                        </div>
                                        <input type="text" id="username" name="username" value="{{ filter_var($user_user->username, FILTER_SANITIZE_SPECIAL_CHARS) }}" class="form-control" disabled>
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            First name
                                        </div>
                                        <input type="text" id="firstname" name="firstname" value="@if(count($errors) > 0){{ old('firstname') }}@else{{ filter_var($user_user->firstname, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Middle name
                                        </div>
                                        <input type="text" id="middlename" name="middlename" value="@if(count($errors) > 0){{ old('middlename') }}@else{{ filter_var($user_user->middlename, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Surname
                                        </div>
                                        <input type="text" id="surname" name="surname" value="@if(count($errors) > 0){{ old('surname') }}@else{{ filter_var($user_user->surname, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Phone
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="phone" name="phone" value="@if(count($errors) > 0){{ old('phone') }}@else{{ filter_var($user_profile->phone, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="text" id="phone" name="phone" value="@if(count($errors) > 0){{ old('phone') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                    </div>
                                </div>
<?php /*
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Email
                                        </div>
                                        <input type="email" id="email" name="email" value="@if(count($errors) > 0){{ old('email') }}@else{{ filter_var($user_user->email, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
*/ ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon col-lg-12">
                                            Date of birth (MM/DD/YYYY): 12/31/1960
                                        </div>
                                        <div class="input-group-addon">
                                            Date of birth
                                        </div>
                                @if($user_profile != '')
                                        <input type="date" id="date_of_birth" name="date_of_birth" value="@if(count($errors) > 0){{ old('date_of_birth') }}@else{{ filter_var($user_profile->date_of_birth, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="date" id="date_of_birth" name="date_of_birth" value="@if(count($errors) > 0){{ old('date_of_birth') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Gender
                                        </div>
                                        <select id="gender" name="gender" class="form-control">
                                @if($user_profile->gender != '')
                                    @if(count($errors) > 0)
                                            <option value="{{ old('gender') }}" selected>{{ ucwords(old('gender')) }}</option>
                                            <option value="">Are you Male/Female</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                    @else
                                            <option value="{{ $user_profile->gender }}" selected>{{ ucwords($user_profile->gender) }}</option>
                                            <option value="">Are you Male/Female</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                    @endif
                                @else
                                    @if(count($errors) > 0)
                                            <option value="{{ old('gender') }}" selected>{{ ucwords(old('gender')) }}</option>
                                            <option value="">Are you Male/Female</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                    @else
                                            <option value="" selected>Are you Male/Female</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                    @endif
                                @endif
                                        </select>
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            City
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="city" name="city" value="@if(count($errors) > 0){{ old('city') }}@else{{ filter_var($user_profile->city, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="text" id="city" name="city" value="@if(count($errors) > 0){{ old('city') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-home"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            State
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="state" name="state" value="@if(count($errors) > 0){{ old('state') }}@else{{ filter_var($user_profile->state, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                    <input type="text" id="state" name="state" value="@if(count($errors) > 0){{ old('state') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-home"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Address
                                        </div>
                                @if($user_profile != '')
                                        <textarea class="form-control" id="address" name="address">@if(count($errors) > 0){{ old('address') }}@else{{ filter_var($user_profile->address, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif</textarea>
                                @else
                                        <input type="text" id="address" name="address" value="@if(count($errors) > 0){{ old('address') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-home"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Postcode
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="postcode" name="postcode" value="@if(count($errors) > 0){{ old('postcode') }}@else{{ filter_var($user_profile->postcode, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="text" id="postcode" name="postcode" value="@if(count($errors) > 0){{ old('postcode') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            About me
                                        </div>
                                @if($user_profile != '')
                                        <textarea class="form-control" id="about_me" name="about_me">@if(count($errors) > 0){{ old('about_me') }}@else{{ filter_var($user_profile->about_me, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif</textarea>
                                @else
                                        <textarea class="form-control" id="about_me" name="about_me">@if(count($errors) > 0){{ old('about_me') }}@else{{ '' }}@endif</textarea>
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Hobbies
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="hobbies" name="hobbies" value="@if(count($errors) > 0){{ old('hobbies') }}@else{{ filter_var($user_profile->hobbies, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="text" id="hobbies" name="hobbies" value="@if(count($errors) > 0){{ old('hobbies') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Religion
                                        </div>
                                @if($user_profile != '')
                                        <input type="text" id="religion" name="religion" value="@if(count($errors) > 0){{ old('religion') }}@else{{ filter_var($user_profile->religion, FILTER_SANITIZE_SPECIAL_CHARS) }}@endif" class="form-control">
                                @else
                                        <input type="text" id="religion" name="religion" value="@if(count($errors) > 0){{ old('religion') }}@else{{''}}@endif" class="form-control">
                                @endif
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Religious level
                                        </div>
                                        <select id="religious_level" name="religious_level" class="form-control">
                                            <option value="">How religious are you</option>
                                    @if(count($errors) > 0)
                                            <option value="{{ old('religious_level') }}" selected>{{ ucwords(old('religious_level')) }}</option>
                                    @else
                                            <option value="{{ $user_profile->religious_level }}" selected>{{ ucwords($user_profile->religious_level) }}</option>
                                    @endif
                                            <option value="very religious">Very Religious</option>
                                            <option value="moderately religious">Moderately Religious</option>
                                            <option value="a little religious">A Little Religious</option>
                                            <option value="not religious">Not Religious</option>
                                        </select>
                                        <div class="input-group-addon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="ID" value="Auth::user()->id">
                                        <button type="submit" name="submit"  class="btn btn-primary">
                                          {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                </form>
@endsection