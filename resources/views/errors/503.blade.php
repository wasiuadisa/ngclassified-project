<?php
$pageTitle = "Error 503 ";
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
                                <h3>{{ $pageTitle }}</h3>
                            </div>
                            <div class="anime__details__btn">
                                <h3 style="color: white;">Error 503! Service Unavailable</h3>
                                <h4 style="color: white;">The Page you are looking is not available because service is unavailable.</h4>
                                <h4 style="color: white;">Service will also be unavailable, if {{ config('app.short_name') }} is under maintenance.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Anime Section End -->
@endsection
