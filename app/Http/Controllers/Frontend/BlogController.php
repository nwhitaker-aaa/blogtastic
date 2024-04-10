<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();

        return view('frontend.blogs.view', ['blogs' => $blogs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try
        {
            $blog = Blog::where('id', $id)->first();
        }
        catch (\Exception $e)
        {
            flash('There was an error when trying to show the blog entry. Please try again.', 'error')->important();
            \Bugsnag::notifyException($e);
            return redirect()->route('home');
        }
        return view('frontend.blogs.show', compact('blog'));
    }
}
