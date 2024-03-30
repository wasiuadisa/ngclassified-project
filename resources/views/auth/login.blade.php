<?php $pageTitle = 'Login'; ?>
@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
@endsection

@extends('layouts.template_list')

@section('content')
    
    <div class="site-section bg-light" style="margin-top: 100px;">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-7 text-left border-primary">
            <h2 class="font-weight-light text-primary">{{ $pageTitle }}</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-7 mb-5"  data-aos="fade">
    
            <form method="POST" action="{{ route('login') }}">
                @csrf 

                @if( count($errors) > 0 )
                <ul class="alert alert-danger text-center list-unstyled" role="alert">
                <!-- List all available errors -->
                @foreach( $errors->all() as $error )                                
                    <li style="color: black;">{{ $error }}</li>
                @endforeach
                </ul>
                <hr>
                @endif
                @if( session('membershipInfo') )
                <!-- Errors for message -->
                <ul class="alert alert-success list list-unstyled text-center" role="alert">
                    <li style="color: black;">{{ session('membershipInfo') }}</li>
                </ul>
                <hr>
                @endif
<?php //Drop the session messages
session()->forget(['membershipInfo']); ?>
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password</label> 
                  <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <p>Don't have an account? <a href="{{ route('register') }}">Register</a> || 
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="forget_pass">Forgot Your Password?</a>
                  @endif</p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="{{ __('Login') }}" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </div>
@endsection