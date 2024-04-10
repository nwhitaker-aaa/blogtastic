@extends('admin.layouts.login')

@section('content')
    <div class="col-md-12">
        <div class="header">
            <h2>Edit <strong>User</strong> Details</h2>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body bg-white">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('admin.forms.user', ['method' => 'put'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
