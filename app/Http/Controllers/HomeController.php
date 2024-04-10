<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $blogs = Blog::all();
        } catch (\Exception $e) {
            \Bugsnag::notifyException($e);
            Log::error($e->getMessage());
        }

        return view('frontend.home', [
            'blogs' => $blogs ?? [],
        ]);
    }
}
