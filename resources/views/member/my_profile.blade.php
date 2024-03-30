<?php $pageTitle = "My Profile"; ?>

@section('pageTitle') {{ $pageTitle }} | @endsection

@section('extra_script') <style >
        .customRow {
            margin-top: 20px;
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
                        <h1>{{ $pageTitle }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('profile.dashboard') }}" class="text-dark">Dashboard</a></li>
                            <li class="active">{{ $pageTitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Notice</span> <br>Except your Username, First name and Surname, the rest of your information is invisible to members. Your info is confidential.
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
<?php /*
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
*/ ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user"></i><strong class="card-title pl-2">Profile Card</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block" src="{{ asset('profile/' . Auth::user()->profileimage) }}" alt="{{ Auth::user()->firstname }}'s profile photo">
                            <h5 class="text-sm-center mt-2 mb-1">{{ Auth::user()->firstname }} {{ Auth::user()->surname }}</h5>
                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> @if($user_profile != ''){{ ucwords($user_profile->state) . ', ' }}@endif Nigeria.</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('profile.edit') }}"><button type="button" class="btn btn-primary btn-lg btn-block">Edit My Profile</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">General info</strong>
                    </div>
<?php
    if(Auth::user()->privilege == 1)
    { $userRole = "Ordinary Member"; $colourClass = 'bg-danger'; }
    elseif (Auth::user()->privilege == 2) { $userRole = "Vetted Member"; $colourClass = 'bg-warning'; }
    elseif (Auth::user()->privilege == 3) { $userRole = "Contributing Member"; $colourClass = 'bg-success'; }
    elseif (Auth::user()->privilege == 4) { $userRole = "Supervising Member"; $colourClass = 'bg-success'; }
    elseif (Auth::user()->privilege == 5) { $userRole = "Moderator"; $colourClass = 'bg-primary'; }
    elseif (Auth::user()->privilege == 6) { $userRole = "Super Moderator"; $colourClass = 'bg-primary'; }
    elseif (Auth::user()->privilege == 7) { $userRole = "Administrator"; $colourClass = 'bg-link'; }
?>
                    <div class="card-header {{ $colourClass }} pull-right">
                        <strong class="card-title pull-right">Member status: {{ $userRole }}</strong>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"><b>First name</b></div>
                            <div class="col-md-4"><b>Middle name</b></div>
                            <div class="col-md-4"><b>Surname</b></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">{{ ucwords(Auth::user()->firstname) }}</div>
                            <div class="col-md-4">{{ ucwords(Auth::user()->middlename) }}</div>
                            <div class="col-md-4">{{ ucwords(Auth::user()->surname) }}</div>
                        </div>

                        <div class="row customRow">
                            <div class="col-md-5"><b>Date of birth: </b> </div>
                        @if($user_profile->date_of_birth !== '')
                            <div class="col-md-7"><?php
$date = new DateTimeImmutable($user_profile->date_of_birth);
echo $date->format('F d, Y.'); ?></div>
                        @else<div class="col-md-7">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Email: </b> {{ Auth::user()->email }}</div>
                        @if($user_profile->phone != '')
                            <div class="col-md-6"><b>Phone: </b> {{ $user_profile->phone }}</div>
                        @else
                            <div class="col-md-6"><b>Phone: </b> Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-4"><b>About me</b></div>
                        @if($user_profile->about_me != '')
                            <div class="col-md-8">{{ $user_profile->about_me }}</div>
                        @else
                            <div class="col-md-8">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-4"><b>Hobbies</b></div>
                        @if($user_profile->hobbies != '')
                            <div class="col-md-8">{{ $user_profile->hobbies }}</div>
                        @else
                            <div class="col-md-8">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Gender: </b></div>
                        @if($user_profile->gender != '')
                            <div class="col-md-6">{{ ucwords($user_profile->gender) }}</div>
                        @else
                            <div class="col-md-6">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-4"><b>Address</b></div>
                        @if($user_profile->address != '')
                            <div class="col-md-8">{{ ucwords($user_profile->address) }}</div>
                        @else
                            <div class="col-md-8">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Postcode: </b> </div>
                        @if($user_profile->postcode != '')
                            <div class="col-md-6">{{ ucwords($user_profile->postcode) }}</div>
                        @else
                            <div class="col-md-6">{{ ucwords($user_profile->postcode) }}</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-12"><b>City, State, Country.</b></div>
                            <div class="col-md-12"><?php
    if($user_profile->city == '')
    { $city = ''; }
    else{ $city = ucwords($user_profile->city) . ', '; }

    if($user_profile->state == '')
    { $state = ''; }
    else{ $state = ucwords($user_profile->state) . ', '; } ?>{{ $city . $state . ' Nigeria.' }}</div>
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Religion</b></div>
                        @if($user_profile->religion != '')
                            <div class="col-md-6">{{ ucwords($user_profile->religion) }}</div>
                        @else
                            <div class="col-md-6">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Religious level</b></div>
                        @if($user_profile->religious_level != '')
                            <div class="col-md-6">{{ ucwords($user_profile->religious_level) }}</div>
                        @else
                            <div class="col-md-6">Not set</div>
                        @endif
                        </div>

                        <div class="row customRow">
                            <div class="col-md-6"><b>Number of views</b></div>
                            <div class="col-md-6">{{ number_format($user_profile->view_count) }}</div>
                        </div>

                    </div>

                </div>

            </div>
@endsection