<?php $pageTitle = ucfirst($user_user->firstname) . "'s Profile"; ?>

@section('pageTitle') {{ $pageTitle }} | @endsection

@section('extra_script') <style >
        .customRow {
            margin-bottom: 20px;
        }
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
                            <li class="active">{{ $pageTitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-user"></i><strong class="card-title pl-2">Profile Card</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block" src="{{ asset('profile/' . $user_user->profileimage) }}" alt="{{ $user_user->firstname }}s' profile photo">
                            <h5 class="mt-2 mb-1"><b>Full name: </b>{{ $user_user->firstname }} {{ $user_user->surname }}</h5>
                            <h4><b>Username: </b>{{ $user_user->username }}</h4>
@if($user_profile != '')
                            <div class="location text-sm-center"><i class="fa fa-map-marker"></i> {{ ucwords($user_profile->state) }}, Nigeria.</div>
@endif
                        </div>
                        <hr>
                    </div><?php /*
                    <div class="card-body">
                        <a href="{{-- route('') --}}"><button type="button" class="btn btn-primary btn-lg btn-block">Send {{ $user_user->firstname }} a message</button></a>
                    </div>*/ ?>
                </div>
            </div>

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">General info</strong>
                    </div>
<?php
    if($user_user->privilege == 1)
    { $userRole = "Ordinary Member"; $colourClass = 'bg-danger'; }
    elseif ($user_user->privilege == 2) { $userRole = "Vetted Member"; $colourClass = 'bg-warning'; }
    elseif ($user_user->privilege == 3) { $userRole = "Contributing Member"; $colourClass = 'bg-success'; }
    elseif ($user_user->privilege == 4) { $userRole = "Supervising Member"; $colourClass = 'bg-success'; }
    elseif ($user_user->privilege == 5) { $userRole = "Moderator"; $colourClass = 'bg-primary'; }
    elseif ($user_user->privilege == 6) { $userRole = "Super Moderator"; $colourClass = 'bg-primary'; }
    elseif ($user_user->privilege == 7) { $userRole = "Administrator"; $colourClass = 'bg-link'; }
?>
                    <div class="card-header {{ $colourClass }} pull-right">
                        <strong class="card-title pull-right">Member status: {{ $userRole }}</strong>
                    </div>

                    <div class="card-body">
                        <div class="row customRow">
                            <div class="col-md-6"><b>Joined {{ config('app.name') }} on: </b> </div>
                            <?php
                            $format = 'Y-m-d H:i:s';
                            $date = DateTime::createFromFormat($format, $user_user->created_at); ?>
                            <div class="col-md-6">{{ $date->format('l, d F, Y.') }}</div>
                        </div>

                        <div class="row customRow">
                            <div class="col-md-12"><b>Description of Member statuses</b></div>

                            <div class="col-md-3"><button class="btn btn-sm btn-primary">Super Moderator</button></div>
                            <div class="col-md-9">This is the Super Moderator level. This member can penalise any Moderator and has the highest privileges after the Administrator.</div>
                            <hr>
                            <br>
                            <div class="col-md-3"><button class="btn btn-sm btn-primary">Moderator</button></div>
                            <div class="col-md-9">This is the Supervising Member who can penalise other members without Moderator privileges. He can also </div>
                            <hr>
                            <br>
                            <div class="col-md-3"><button class="btn btn-sm btn-success">Supervising Member</button></div>
                            <div class="col-md-9">This is a Contributing Member who supervises other Contributing Members' contents.</div>
                            <hr>
                            <br>
                            <div class="col-md-3"><button class="btn btn-sm btn-success">Contributing Member</button></div>
                            <div class="col-md-9">This member has been vetted and also contributes content on the site.</div>
                            <hr>
                            <br>
                            <div class="col-md-3"><button class="btn btn-sm btn-warning">Vetted Member</button></div>
                            <div class="col-md-9">This member has met the most basic requirement and the member's NIN has been confirmed.</div>
                            <hr>
                            <br>
                            <div class="col-md-3"><button class="btn btn-sm btn-danger">Ordinary Member</button></div>
                            <div class="col-md-9">This member has met the most basic requirement but has not been vetted.</div>
                        </div>

                    </div>

                </div>

            </div>
@endsection