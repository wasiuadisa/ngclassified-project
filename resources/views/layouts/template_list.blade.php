<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>{{ $pageTitle }} | {{ config('app.short_name') }} - {{ config('app.slogan') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('storage/assets/images/favicon.png') }}" rel="icon">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.meta_description') }}">
    <meta name="keywords" content="{{ config('app.meta_keywords') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/assets/css/style.css') }}">
  </head>

  <body>  
  <div class="site-wrap">
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar container py-0 bg-white" role="banner">
      <!-- <div class="container"> -->
        <div class="row align-items-center">
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="{{ route('index') }}" class="text-black mb-0"> {{ config('app.short_name') }} <span class="text-primary"></span>  </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('popular') }}">Popular</a></li>
                <li><a href="{{ route('recent') }}">Recent</a></li>
                <li class="has-children">
                  <a href="#">Categories</a>
                  <ul class="dropdown">
                  <?php $categoriesList = (new \App\Logic\Posts)->listCategories(); ?>
                  @foreach($categoriesList as $categories)
                    <li><a href="{{ route('category', [ ucfirst($categories->name), config('app.list_length') ]) }}">{{ ucfirst($categories->name) }}</a></li>
                  @endforeach
                  </ul>
                </li>
                @if(Auth::user())
                <li class="ml-xl-3 login"><span class="border-left pl-xl-4"><a href="{{ route('dashboard') }}"></span>Dashboard</a></li>
                @else
                <li class="ml-xl-3 login"><span class="border-left pl-xl-4"><a href="{{ route('register') }}"></span>Register</a></li>
                <li><a href="{{ route('login') }}">Log In</a></li>
                @endif
                <li><a href="{{ route('new_post.form') }}" class="cta"><span class="bg-primary text-white rounded">+ Post an Ad</span></a></li>
              </ul>
            </nav>
          </div>
          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      <!-- </div> -->      
    </header>

@yield('content')

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-4">
                <h2 class="footer-heading mb-4">Navigations</h2>
                <ul class="list-unstyled">
                  <li><a href="{{ route('index') }}">Home</a></li>
                  <li><a href="{{ route('popular') }}">Popular</a></li>
                  <li><a href="{{ route('recent') }}">Recent</a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <form method="get" action="{{ route('search_page') }}">
              @csrf
              <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control border-secondary text-white bg-transparent" placeholder="Search listings..." aria-describedby="button-addon2">
                <input type="hidden" name="category" value="all">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="submit" id="button-addon2">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
        
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p style="color: white;">&copy; <script>document.write(new Date().getFullYear());</script> <a href="" target="_blank" style="color: white;"> {{ config('app.short_name') }} </a> | All rights reserved</p>
            <p style="color: white;"><a href="" target="_blank" style="color: white;">{{ config('app.short_name') }} </a> is developed by <a href="{{ config('app.founder_linkedin') }}" style="color: white;">Wasiu Adisa</a></p>
            </div>
          </div>

        </div>
      </div>
    </footer>
  </div>

    <!-- Bootstrap 5 -->
    <div class="floating-button-div">
        <a id="button" class="btn btn-dark" style="top:40%;right:1%;position:fixed;z-index: 9999" href="../../../">Developer Website</a>
    </div>

  <script src="{{ asset('storage/assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('storage/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('storage/assets/js/aos.js') }}"></script>

  <script src="{{ asset('storage/assets/js/main.js') }}"></script>
    
  </body>
</html>