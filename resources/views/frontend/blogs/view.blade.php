@extends('frontend.layouts.layout-main')
@section('content')
    <div class="row">
        <div class="blogspot col-xs-12 col-lg-12">
            @foreach ($blogs as $blog)
                <div class="blogger col-lg-5 col-xs-12">
                    <a href="{{ route('blog.show', $blog->id) }}">
                        <div class="title">
                            <label for="title">Title: </label>
                            {{ $blog->title }}
                        </div>
                        <div class="author">
                            <label for="author">Author: </label>
                            {{ $blog->author }}
                        </div>
                        <div class="createdat">
                            <label for="createdat">Created: </label>
                            {{ $blog->created_at }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
