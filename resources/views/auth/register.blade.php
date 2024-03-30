<?php $pageTitle = 'Register'; ?>
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
    
            <form method="POST" action="{{ route('register') }}">
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

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="firstname">First name *</label> 
                  <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="middlename">Middle name</label> 
                  <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="surname">Surname *</label> 
                  <input type="text" id="surname" name="surname" value="{{ old('surname') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="username">Username *</label> 
                  <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control">
                </div>
              </div>
                
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email *</label> 
                  <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password *</label>
                  <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="password_confirmation">Confirm Password *</label>
                  <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="{{ __('Register') }}" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </div>
<?php //Drop the session messages
session()->forget(['membershipInfo']); ?>
@endsection