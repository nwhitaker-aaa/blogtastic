@extends('admin.layouts.login')

@section('content')

    <div class="col-md-12">
        <div class="header">
            <h2><strong>Blog</strong> Details</h2>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body bg-white">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('admin.forms.blog', ['route' => 'admin.blogs.store'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
