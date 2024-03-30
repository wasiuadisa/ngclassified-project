@section('pageTitle') {{ $pageTitle }} |  @endsection

@section('extra_css')
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
                            <li class="active">Dashboard</li>
                            <li class="active">{{ $pageTitle }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        <!-- Content area below -->
            @if( session('infoMessage') )
            <!-- Message -->
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Alert!</span> <br>{{ session('infoMessage') }}
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

            <form method="POST" action="{{ route('new_post.upload') }}">
                @csrf
                <!-- Beginning of class="col-lg-12" -->
                <div class="col-lg-12">

                    <!-- Beginning of class="card" -->
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ ucwords($pageTitle) }}</h3>
                        </div>

                        <!-- Beginning of title -->
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Title
                                    </div>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Description
                                    </div>
                                    <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Category
                                    </div>
                                    <select id="category" class="form-control" name="category" required>
                                        <option value="">-- Select category --</option>
<?php $categories = (new \App\Logic\Posts)->listCategories(); ?>
                                        @foreach( $categories as $category )<option value="{{ $category->id }}" @if(old('category') == $category->id){{ 'selected' }} @endif>{{ htmlspecialchars_decode($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Price
                                    </div>
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                
                                <div class="input-group col-lg-6 col-md-4">
                                    <div class="input-group-addon">
                                        Age
                                    </div>
                                    <input type="text" id="age" name="age" value="{{ old('age') }}" class="form-control" required>
                                </div>
                                
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Condition
                                    </div>
                                    <select id="condition" class="form-control" name="condition" required>
                                        @if($errors)
                                        <option value="{{ old('condition') }}" selected>{{ ucfirst(old('condition')) }}</option>
                                        @endif
                                        <option value=""> Used or New </option>
                                        <option value="used">Used</option>
                                        <option value="new">New</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-7 col-md-7">
                                    <div class="input-group-addon">
                                        State
                                    </div>
                                    <input type="text" id="state" class="form-control" name="state" value="{{ old('state') }}">
                                </div>

                                <div class="input-group col-lg-5 col-md-5">
                                    <div class="input-group-addon">
                                        City
                                    </div>
                                    <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block need-space">
                            <div class="form-group">
                                <div class="input-group col-lg-12"><h3>Contact Details</h3></div>
                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Name
                                    </div>
                                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" />
                                </div>

                                <div class="input-group col-lg-6 col-md-6">
                                    <div class="input-group-addon">
                                        Address
                                    </div>
                                    <textarea name="address" id="address" rows="4" class="form-control">{{ old('address') }}</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group col-lg-8 col-md-8">
                                    <div class="input-group-addon">
                                        E-mail address
                                    </div>
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>

                                <div class="input-group col-lg-4 col-md-4">
                                    <div class="input-group-addon">
                                        Phone
                                    </div>
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>

                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="submit" name="submit"  class="btn btn-lg btn-primary">
                                        {{ __('Create New Ad') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
@endsection