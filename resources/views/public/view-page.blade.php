@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
@endsection

@extends('layouts.template_list')

@section('content')

    <div class="site-section" style="margin-top: 100px;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2>{{ $post->title }}</h2>
          </div>
          <div class="col-lg-8">

            <div class="mb-4">
              <img src="{{ asset('image/' . $post->filename) }}" alt="{{ $post->title }}" class="img-fluid">
            </div>

            <h4 class="h5 mb-4 text-black">Description</h4>
            {{ $post->description }}

          </div>

          <div class="col-lg-3 ml-auto" style="margin-top: 50px;">

            <div class="mb-5">@if($post->price != '')
              <h3 class="h5 text-black mb-3">Pice: ₦{{ number_format($post->price) }}</h3>@endif
              <form action="#" method="post">
                <div class="form-group">
                  <b>Age:</b> {{ $post->age }}
                </div>
                <div class="form-group">
                  <b>Condition:</b> {{ $post->condition }}
                </div>
              </form>
            </div>

            <div class="mb-5">
              <form action="#" method="post">
                <div class="form-group">
                  <h4>Contact details</h4>
                  <p>{{ $post->contact_name }}</p>
                  <p>{{ $post->contact_address }}</p>
                  <p>{{ $post->contact_phone }}</p>
                  <p>{{ $post->contact_email }}</p>
                </div>
                <div class="form-group">
                  <ul class="list-unstyled">
                    <li>
                      <label for="option1">
                        <b>{{ $post->city . ', ' . $post->state }}</b>
                      </label>
                    </li>
                  </ul>
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>
    </div>

@endsection