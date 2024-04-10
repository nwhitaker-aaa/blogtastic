<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>@yield('title', 'Blog Admin' )</title>
</head>
<body class="fixed-topbar fixed-sidebar theme-sdtl color-primary dashboard">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<section>
    {{-- BEGIN SIDEBAR --}}
    <div class="sidebar">
        <div class="logopanel">
            <h1>
                <a href="{{ route('admin.blogs') }}"></a>
            </h1>
        </div>
        <div class="sidebar-inner">
            <div class="sidebar-top">
            </div>
            <div class="menu-title">
                Navigation
            </div>
            <ul class="nav nav-sidebar">
                @if($currentUser->can('blogs'))
                    <li {!! App\Classes\Application\AppHelper::setActive('admin/blogs', ['nav-parent'], true) !!}>
                        <a href="#">
                            <i class="glyphicon glyphicon-home"></i><span>Blog Management </span><span class="fa arrow"></span>
                        </a>
                        <ul class="children collapse">
                            <li><a href="{{route('admin.blogs')}}"> View Blogs</a></li>
                            <li><a href="{{route('admin.blogs.create')}}"> Create Blogs</a></li>
                        </ul>
                    </li>
                @endif
{{--                @if($currentUser->can('messages'))--}}
{{--                    <li {!! App\Classes\Application\AppHelper::setActive('admin/messages', ['nav-parent'], true) !!}>--}}
{{--                        <a href="#">--}}
{{--                            <i class="glyphicon glyphicon-envelope"></i><span>Message Management </span><span class="fa arrow"></span>--}}
{{--                        </a>--}}
{{--                        <ul class="children collapse">--}}
{{--                            <li><a href="{{ route('admin.messages')}}"> View Messages</a></li>--}}
{{--                            <li><a href="{{ route('admin.messages.create')}}"> Create Message</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}
                @if($currentUser->can('users'))
                    <li {!! App\Classes\Application\AppHelper::setActive('admin/users', ['nav-parent'], true) !!}>
                        <a href="#">
                            <i class="glyphicon glyphicon-user"></i><span>User Management </span><span class="fa arrow"></span>
                        </a>
                        <ul class="children collapse">
                            <li><a href="{{ route('admin.users')}}"> View Users</a></li>
                            <li><a href="{{ route('admin.users.create')}}"> Create User</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    {{-- END SIDEBAR --}}
    <div class="main-content">
        {{-- BEGIN TOPBAR --}}
        <div class="topbar">
            <div class="header-left">
                <div class="topnav">
                    <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span
                            class="menu__handle"><span>Menu</span></span></a>
                </div>
            </div>
            <div class="header-right">
                <ul class="header-menu nav navbar-nav">
                    {{-- BEGIN USER DROPDOWN --}}
                    <li class="dropdown" id="user-header">
                        <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-user"></i>&nbsp;
                            <span class="username">Hi, {{ $currentUser->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('admin.home.index') }}"
                                   onclick="e.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="icon-logout"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('admin.home.index') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{-- END USER DROPDOWN --}}
                </ul>
            </div>
            {{-- header-right --}}
        </div>
        {{-- END TOPBAR --}}
        {{-- BEGIN PAGE CONTENT --}}
        <div class="page-content">
            @include('flash::message')
            @yield('content')
        </div>
        {{-- END PAGE CONTENT --}}
    </div>
    {{-- END MAIN CONTENT --}}
</section>
{{-- BEGIN PRELOADER --}}
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
{{-- END PRELOADER --}}
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
{{-- BEGIN PAGE SCRIPT --}}
@yield('scripts')
{{-- END PAGE SCRIPT --}}
</body>
</html>
