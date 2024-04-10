<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->hasPermissionTo('blogs.all')) {
            $blogs = Blog::withTrashed()->get();
        } elseif (Auth::user()->hasPermissionTo('blogs')) {
            $blogs = Blog::withTrashed()->where('user_id', Auth::user()->id)->get();
        } else {
            return view('blogs.index');
        }

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $blogs = Blog::pluck('title', 'id', 'slug')->toArray();

        return view('admin.blogs.create', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        try
        {
            $blog = new Blog();
            $blog->user_id = $user_id;
            $blog->title = $request->input('title');
            $blog->author = $request->input('author');
            $blog->description = $request->input('description');
            $blog->details = $request->input('details');

            $blog->save();

            flash('New Blog Created Successfully!', 'success')->important();

            return redirect()->route('admin.blogs', ['id' => $blog->id]);
        } catch (\Exception $e) {
            flash('There was an error when trying to create the blog. Please try again.', 'error')->important();
            \Bugsnag::notifyException($e);
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $blog = Blog::where('id', $id)->first();

            return view('admin.blogs.edit', [
                'blog'    => $blog,
            ]);
        } catch (\Exception $e) {
            flash('There was an error when trying to find the blog. Please try again.', 'error')->important();
            \Bugsnag::notifyException($e);
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $blog = Blog::where('id', $id)->first();

            $data = [
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'description' => $request->input('description'),
                'details' => $request->input('details'),
            ];

            $blog->update($data);

            $blog->save();

            flash('Blog Updated Successfully!', 'success')->important();

            return redirect()->route('admin.blogs');
        } catch (\Exception $e) {
            \Bugsnag::notifyException($e);
            flash('There was an error when trying to update the blog. Please try again.', 'error')->important();
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, $permanent = false)
    {
        try {
            $blog = Blog::withTrashed()->where('id', $id)->first();

            if(!$blog){
                flash('There was an error when trying to delete the blog. Please try again.', 'danger')->important();
                return redirect()->back();
            }

            $message = 'Blog '.($permanent ? 'Permanently ' : '').'Deleted Successfully!';

            if(!$permanent){
                $blog->delete();
            } else {
                $blog->forceDelete();
            }

            flash($message, 'success');
        } catch (\Exception $e) {
            flash('There was an error when trying to delete the blog. Please try again.', 'error')->important();
            \Bugsnag::notifyException($e);
        }

        return redirect()->route('admin.blogs');
    }

    /**
     * Restore a user
     *
     * @param string  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $blog = Blog::withTrashed()->where('id', $id)->first();

            if(!$blog){
                flash('No blog was found. Please try again.');
                return redirect()->back();
            }

            $blog->restore();

            flash('Blog Successfully Restored!', 'success');
        } catch (\Exception $e) {
            \Bugsnag::notifyException($e);
        }

        return redirect()->route('admin.blogs');
    }
}
