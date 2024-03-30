<?php $pageTitle = "My Security Question and Answer Change"; ?>

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
                            <li><a class="breadcrumbLink" href="{{ route('member.dashboard') }}">Dashboard</a></li>
                            <li><a class="breadcrumbLink" href="{{ route('member.password_change_form') }}">Change Password</a></li>
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
                    <span class="badge badge-pill badge-danger">Warning</span> <br>Keep your security question and answer safe and don't disclose them to anyone.
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

                <form action="{{ route('member.security_question_change_processing', Auth::user()->id) }}" method="post">
                    @csrf
                    <div class="col-lg-8 offset-lg-2 col-md-8">
                        <div class="card">
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Security Question
                                        </div>
                                        <input type="text" id="question" name="question" value="{{ old('question') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Security Answer
                                        </div>
                                        <input type="text" id="answer" name="answer" value="{{ old('answer') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="ID" value="Auth::user()->id">
                                        <button type="submit" name="submit"  class="btn btn-primary">
                                          {{ __('Update My Settings') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
        <!----- End of class="content mt-3" is in template file ---------->
@endsection