@extends('frontend.layouts.layout-main')
@section('content')

    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="col-lg-6 col-xs-12">
                <div class="title">
                    <label for="title">Title: </label><br/>
                    <h2>{{ $blog->title }}</h2>
                </div>
                <div class="author">
                    <label for="author">Author: </label><br/>
                    <h3>{{ $blog->author }}</h3>
                </div>
                <div class="createdat">
                    <label for="createdat">Created: </label><br/>
                    <h6>{{ date_format($blog->created_at, 'D, M d Y') }}</h6>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-xs-12 col-lg-12">
            <div class="description">
                <h3>-{{ $blog->description }}</h3>
            </div>
        </div>
        <hr>
        <div class="col-xs-12 col-lg-12">
            <div class="details">
                <h3>{{ $blog->details }}</h3>
            </div>
        </div>
    </div>
@endsection
