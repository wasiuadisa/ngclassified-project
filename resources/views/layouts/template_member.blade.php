<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex">
    <title>@yield('pageTitle') | {{ config('app.name') }} - {{ config('app.slogan') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link href="{{ asset('storage/assets/images/favicon.png') }}" rel="icon">

    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/selectFX/css/cs-skin-elastic.css') }}">
    
    <?php if(isset($maps)){ ?><link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/jqvmap/dist/jqvmap.min.css') }}"><?php } ?>
    <?php if(isset($forms)){ ?><link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/chosen/chosen.min.css') }}"><?php } ?>
    <?php if(isset($dataTables)){ ?><link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/templates_member/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"><?php } ?>
    @yield('extra_script')
    @yield('extra_css')
    <link rel="stylesheet" href="{{ asset('storage/templates_member/assets/css/style.css') }}">
</head>

<body>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage/assets/images/logo.png') }}" alt="{{ config('app.short_name') }}">
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ route('dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li>
                        <a href="{{ route('new_post.form') }}"> <i class="menu-icon fa fa-film"></i>Create New Ad</a>
                    </li>
                    <li>
                        <a href="{{ route('post.all') }}"><i class="menu-icon fa fa-list"></i>My Posts</a>
                    </li>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li>
                        <a class="menu-icon" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            this.closest('form').submit();"> <i class="menu-icon fa fa-power-off"></i>{{ __('Log Out') }}
                        </a>
                    </li>
                </form>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i> My Posts By Category </a>
                        <ul class="sub-menu children dropdown-menu">
<?php $category = (new \App\Logic\Posts)->listCategories(); ?>
                        @foreach($category as $cat)
                            <li>
                                <i class="menu-icon fa fa-search"></i>
                                <a href="{{ route('post.category', [ucfirst($cat->name), config('app.list_length')]) }}">{{ ucfirst($cat->name) }}</a>
                            </li>
                        @endforeach
                        </ul>
                    </li>
                    <!---------------->
                    <h3 class="menu-title">Navigation</h3>
                    <!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Featured List</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-list"></i>
                                <a href="{{ route('post.recent') }}">Recent Posts</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-list"></i>
                                <a href="{{ route('post.popular') }}">Popular Posts</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="{{ route('dashboard') }}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if(Auth::user()->profileimage == ''){ $profile_image = 'profile.png'; }else{ $profile_image = Auth::user()->profileimage; } ?>
                            <img class="user-avatar rounded-circle" src="{{ asset('profile/' . $profile_image) }}" alt="{{ ucfirst(Auth::user()->firstname) }}'s photo"/>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('dashboard') }}"> <b style="color: black;"> {{ ucfirst(Auth::user()->firstname) . ' ' . ucfirst(Auth::user()->surname) }}</b></a>

                            <a class="nav-link" href="{{ route('profile.edit') }}"><i class="fa fa-user"></i> My Profile</a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="fa fa-power-off"></i> {{ __('Log Out') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        <!-----------------------  ----------------------->

        @yield('content')

        <!-----------------------  ----------------------->
        </div>
        <!-- End of content mt-3 -->

        <!-- footer-copyright -->
        <div class="col-xl-12 col-lg-12" style="margin-bottom: -20px;">
            <div class="card">
                <div class="card-footer">
                    <p>© <?php
             if( date('Y') > 2021 )
             {
                printf( '2021 - ' . date('Y') );
             }
             else {
                printf( date('Y') );
             }
             ?>. {{ config('app.short_name') }} is developed by <a href="{{ config('app.founder_linkedin') }}" style="color: blue;">Wasiu Adisa</a></p>
                </div>
            </div>
        </div>
        <!-- End of footer-copyright -->

    </div>
    <!-- End of Right Panel -->

    <!-- Bootstrap 5 -->
    <div class="floating-button-div">
        <a id="button" class="btn btn-dark" style="top:40%;right:1%;position:fixed;z-index: 9999" href="../../../">Developer Website</a>
    </div>

    <script src="{{ asset('storage/templates_member/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/assets/js/main.js') }}"></script>

    <script src="{{ asset('storage/templates_member/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('storage/templates_member/assets/js/widgets.js') }}"></script>

    <?php if(isset($maps)){ ?><script src="{{ asset('storage/templates_member/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script><?php  } ?>
    
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

    <?php if(isset($forms)){ ?><script src="{{ asset('storage/templates_member/vendors/chosen/chosen.jquery.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, found nothing!",
                width: "100%"
            });
        });
    </script><?php } ?>

    <?php if(isset($dataTables)){ ?><script src="{{ asset('storage/templates_member/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('storage/templates_member/assets/js/init-scripts/data-table/datatables-init.js') }}"></script><?php } ?>

</body>

</html>