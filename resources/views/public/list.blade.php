@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
@endsection

@extends('layouts.template_list')

@section('content')
          <!--------------------- LIST ------------------------------->
    
    <div class="site-section bg-light" style="margin-top: 100px;">
        <div class="container">
                  <!---------------------- POPULAR -------------------------->
	        <div class="row mb-5">
	          <div class="col-md-7 text-left border-primary">
	            <h2 class="font-weight-light text-primary">{{ $pageTitle }}</h2>
	          </div>
	        </div>

	        <div class="row mt-5">
      @if(count($listings) != 0)
        @foreach($listings as $popular)
            <div class="col-lg-6">
                <div class="d-block d-md-flex listing">
                  <a href="{{ route('view', [$popular->url_slug, $popular->id]) }}" class="img d-block" style="background-image: url({{ asset('image/' . $popular->filename) }})"></a>
                  <div class="lh-content">
                      <span class="category">{{ (new \App\Logic\Posts)->getCategoryName($popular->mallcategories_id) }}</span>
                      <a href="{{ route('view', [$popular->url_slug, $popular->id]) }}" class="bookmark"></a>
                      <h3><a href="#" style="color: black;">{{ $popular->title }}</a></h3>
                      <address>{{ ucfirst($popular->city) . ', ' . ucfirst($popular->state) }}</address>
                  </div>
                </div>
            </div>
        @endforeach
      @else
            <div class="col-lg-6">
                <div class="d-block d-md-flex listing">
                  <p>Sorry, there're no posts that match what you're looking for.</p>
                </div>
            </div>
      @endif
		    </div>
        {{ $listings->links() }}
		</div>
	</div>
@endsection