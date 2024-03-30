@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
    <style type="text/css">
        .whitenIt a {
            color: white;
        }
        .blackenIt a {
            color: black;
        }
    </style>
@endsection

@extends('layouts.template_member')

@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><a href="{{ route('dashboard') }}" style="color: black;"> Dashboard </a></li>
                            <li class="active">{{ $pageTitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->

            @if( session('info') )
            <!-- Message -->
            <div class="colorl-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> {{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            @if( session('notice') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert alert-{{ session('alert_type') }} alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Psst!</span> {{ session('notice') }}
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

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th class="col-lg-5">Image</th>
                                    <th class="col-lg-5">Title & more</th>
                                    <th class="col-lg-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                      @if (count($posts) > 0)
                          <?php $rowNumber = 1; ?>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('post.view', [$post->id,]) }}">
                                            <img class="mx-auto d-block img-fluid img-thumbnail" src="{{ asset('image/' . $post->filename) }}" alt="{{ $post->title }}" style="width: 45%;">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-5">Title: </div>
                                            <div class="col-lg-7"><a href="{{ route('post.view', [$post->id,]) }}" style="color:white;">{{ $post->title }}</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5">Date</div>
<?php $modified_date = date_create_from_format('Y-m-d H:i:s', "$post->created_at");
    $the_date = date_format($modified_date, 'M d, Y. g:i A'); ?>
                                            <div class="col-lg-7"><a href="{{ route('post.view', [$post->id,]) }}" style="color:white;">{{ $the_date }}</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5">Views: </div>
                                            <div class="col-lg-7">{{ number_format($post->views) }} <?php if($post->views > 1){ echo 'times'; }else{ echo 'time'; } ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5">Description: </div>
                                            <div class="col-lg-7"><?php if($post->description !== ''){ echo Str::substr(ucfirst($post->description), 0, 70) . '...'; }else{ echo 'No description, yet'; } ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('existing_post.delete', $post->id) }}" class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="4">
                                        <p>You have no post, yet.</p>
                                    </td>
                                </tr>
                        @endif
                            </tbody>
                        </table>
                    @if (count($posts) > 0)
                        <div class="col-lg-12">
                            <br><br>
                            <ul class="pagination pagination-lg">
                                {{ $posts->links('vendor.pagination.bootstrap-4') }}
                            </ul>
                        </div>
                    @endif
                        </table>
                    </div>
                </div>
            </div>
<?php //Drop the session messages
session()->forget(['notice', 'info']); ?>
@endsection
