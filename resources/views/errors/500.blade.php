<?php
$pageTitle = "Error 500! - ";
$pageTag =  strtolower($pageTitle) . '-' . config('app.short_name');
?>

@section('extra_meta')
    <meta name="robots" content="noindex,nofollow">
@endsection

@section('pageTitle') {{ $pageTitle }} @endsection

@extends('layouts.template_index')

@section('content')
    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3 col-md-2" style="margin-top:20px;">
                        <img src="{{ asset('storage/ma_assets/img/adspace.png') }}" />
                    </div>
                    <div class="col-lg-3 col-md-2" style="margin-top:20px;">
                        <img src="{{ asset('storage/ma_assets/img/adspace.png') }}" />
                    </div>
                    <div class="col-lg-3 col-md-2" style="margin-top:20px;">
                        <img src="{{ asset('storage/ma_assets/img/adspace.png') }}" />
                    </div>
                    <div class="col-lg-3 col-md-2" style="margin-top:20px; margin-bottom: 50px;">
                        <img src="{{ asset('storage/ma_assets/img/adspace.png') }}" />
                    </div>
                </div>
                <div class="row">
                    </div>
                    <div class="col-lg-12">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $pageTitle }} Internal Server Error</h3>
                            </div>
                            <div class="anime__details__btn">
                                <h4 style="color: white;">The Page you are looking for won't load because the server has encountered an error while processing your requested page.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Anime Section End -->
@endsection
