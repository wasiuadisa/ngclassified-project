@section('pageTitle') {{ $pageTitle }} |  @endsection

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
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->
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
<?php //Drop the session message
session()->forget('membershipInfo'); ?>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-6">
                    <img class="col-lg-12 img-thumbnail" alt="{{ $user_user->firstname }}" src="{{ asset('profile/' . Auth::user()->profileimage) }}">
                </div>
                <hr>
            </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-primary"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total Listings</div>
                                    <div class="stat-digit">{{-- $activePosts --}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-primary"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Total </div>
                                    <div class="stat-digit">{{-- $activePosts --}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection