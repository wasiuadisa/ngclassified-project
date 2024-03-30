<?php $pageTitle = 'Home'; ?>
@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
@endsection

@extends('layouts.template_index')

@section('content')
    <div class="site-blocks-cover overlay" style="background-image: url({{ asset('storage/assets/images/hero_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-12">

            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1 class="" data-aos="fade-up">{{ config('app.slogan') }}</h1>
                <p data-aos="fade-up" data-aos-delay="100" style="color: white;">You can buy, sell anything you want <span>or make a request</span></p>
              </div>
            </div>
<?php $categoriesList = (new \App\Logic\Posts)->listCategories(); ?>

            <div class="form-search-wrap" data-aos="fade-up" data-aos-delay="200">
              <form method="get" action="{{ route('search_page') }}">
                @csrf
                <div class="row align-items-center">

                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-6">
                    <input type="text" name="search" id="search" class="form-control rounded" placeholder="What are you looking for?">
                  </div>

                  <div class="col-lg-6 mb-4 mb-xl-0 col-xl-4">
                    <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select class="form-control rounded" name="category" id="category">
                        <option value="all">All Categories</option>
                    @if($categoriesList != '')
                      @foreach($categoriesList as $cat)
                        <option value="{{ route('category', [ ucfirst($cat->name), config('app.list_length') ]) }}">{{ ucfirst($cat->name) }}</option>
                      @endforeach
                    @else
                        <option>No category yet</option>
                    @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12 col-xl-2 ml-auto text-right">
                    <input type="submit" class="btn btn-primary btn-block rounded" value="Search">
                  </div>

                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        
        <div class="overlap-category mb-5 border border-dark">
          <div class="row align-items-stretch no-gutters">
      @if($categoriesList != '')
          @foreach($categoriesList as $cat)
            <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
              <a href="{{ route('category', [ ucfirst($cat->name), config('app.list_length') ]) }}" class="popular-category h-100">
                <span class="icon"><span class="flaticon-folder"></span></span>
                <span class="caption mb-2 d-block">{{ ucfirst($cat->name) }}</span>
              </a>
            </div>
          @endforeach
      @else
            <div class="col-sm-12 col-md-12 mb-4 mb-lg-0 col-lg-12">
              <a href="#" class="popular-category h-100">
                <span class="icon"><span class="flaticon-folder"></span></span>
                <span class="caption mb-2 d-block">No category yet</span>
              </a>
            </div>
      @endif
          </div>
        </div>
        
      </div>
    </div>

    <div class="site-section bg-light">
      	<div class="container">
        
          <!--------------------- RECENT ------------------------------->
          <div class="row mb-5">
            <div class="col-md-7 text-left border-primary">
              <h2 class="font-weight-light text-primary">Recent posts</h2>
            </div>
          </div>

          <div class="row mt-5">
      @if($recentListings != '')
        @foreach($recentListings as $recent)
            <div class="col-lg-6">
                <div class="d-block d-md-flex listing">
                  <a href="{{ route('view', [$recent->url_slug, $recent->id]) }}" class="img d-block img-thumbnail" style="background-image: url('{{ asset('image/' . $recent->filename) }}')"></a>
                  <div class="lh-content">
                      <span class="category">{{ (new \App\Logic\Posts)->getCategoryName($recent->mallcategories_id) }}</span>
                      <a href="{{ route('view', [$recent->url_slug, $recent->id]) }}" class="bookmark"></a>
                      <h3><a href="{{ route('view', [$recent->url_slug, $recent->id]) }}" style="color: black;">{{ $recent->title }}</a></h3>
                      <address style="color: black;">{{ ucfirst($recent->city) . ', ' . ucfirst($recent->state) }}</address>
                  </div>
                </div>
            </div>
        @endforeach
          </div>
        <div class="row mt-5">
          <div class="col-lg-6">
              <div class="d-block d-md-flex listing">
                <a class="btn btn-primary btn-block rounded" href="{{ route('recent') }}">Show more recent posts</a>
              </div>
          </div>
        </div>
      @else
            <div class="col-lg-12">
                <div class="d-block d-md-flex listing">
                  <a href="{{ route('index') }}" class="img d-block img-thumbnail" style="background-image: url('{{ asset('image/' . config('app.default_image')) }}')"></a>
                  <div class="lh-content">
                      <span class="category">No recent listings</span>
                  </div>
                </div>
            </div>
      @endif
      </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
                  <!---------------------- POPULAR -------------------------->
	        <div class="row mb-5">
	          <div class="col-md-7 text-left border-primary">
	            <h2 class="font-weight-light text-primary">Most Popular</h2>
	          </div>
	        </div>

	        <div class="row mt-5">
      @if($popularListings != '')
        @foreach($popularListings as $popular)
            <div class="col-lg-6">
                <div class="d-block d-md-flex listing">
                  <a href="{{ route('view', [$popular->url_slug, $popular->id]) }}" class="img d-block" style="background-image: url({{ asset('image/' . $popular->filename) }})"></a>
                  <div class="lh-content">
                      <span class="category">{{ (new \App\Logic\Posts)->getCategoryName($popular->mallcategories_id) }}</span>
                      <a href="{{ route('view', [$popular->url_slug, $popular->id]) }}" class="bookmark"></a>
                      <h3><a href="{{ route('view', [$popular->url_slug, $popular->id]) }}" style="color: black;">{{ $popular->title }}</a></h3>
                      <address>{{ ucfirst($popular->city) . ', ' . ucfirst($popular->state) }}</address>
                  </div>
                </div>
            </div>
        @endforeach
		    </div>
        <div class="row mt-5">
          <div class="col-lg-6">
              <div class="d-block d-md-flex listing">
                <a class="btn btn-primary btn-block rounded" href="{{ route('popular') }}">Show more popular posts</a>
              </div>
          </div>
        </div>
      @else
            <div class="col-lg-12">
                <div class="d-block d-md-flex listing">
                  <a href="{{ route('index') }}" class="img d-block img-thumbnail" style="background-image: url('{{ asset('image/' . config('app.default_image')) }}')"></a>
                  <div class="lh-content">
                      <span class="category">No popular listings</span>
                  </div>
                </div>
            </div>
      @endif
		</div>
	</div>

@endsection