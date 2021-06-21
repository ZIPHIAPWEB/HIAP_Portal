<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function showBlogEntry()
    {
        return Inertia::render('Superadmin/BlogEntry', [
            'blogs'     =>  Blog::orderBy('created_at', 'desc')->get()->map->transform()
        ]);
    }

    public function showBlogCreate()
    {
        return Inertia::render('Superadmin/Blog/BlogCreate');
    }

    public function publishBlog(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'initial_content'   =>  'required',
            'content'           =>  'required'
        ]);

        Blog::create([
            'title'             =>  $request->title,
            'slug'              =>  Str::slug($request->title),
            'initial_content'   =>  $request->initial_content,
            'content'           =>  $request->content
        ]);

        return redirect()->to('/sa/blogs');
    }

    public function editBlog($blogId)
    {
        return Inertia::render('Superadmin/Blog/BlogEdit', [
            'selectedBlog'      =>  Blog::where('id', $blogId)->first()
        ]);
    }

    public function updateBlog(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'initial_content'   =>  'required',
            'content'           =>  'required'
        ]);

        Blog::where('id', $request->id)->update([
            'title'             =>  $request->title,
            'slug'              =>  Str::slug($request->title),
            'initial_content'   =>  $request->initial_content,
            'content'           =>  $request->content
        ]);

        return redirect()->to('/sa/blogs');
    }

    public function deleteBlog($blogId)
    {
        Blog::where('id', $blogId)->delete();

        return redirect()->back();
    }

    public function showBlogList()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get()
        ->map(function ($blog) {
            return [
                'title'             =>  $blog->title,
                'initial_content'   =>  $blog->initial_content,
                'view_full_url'     =>  url('/blog/' . $blog->slug),
                'created_at'        =>  $blog->created_at->diffForHumans()
            ];
        });

        return view('frontview.blog')
            ->with('blogs', $blogs);
    }

    public function showSelectedBlog($slug)
    {
        return view('frontview.blog-selected')
            ->with('blog', Blog::where('slug', $slug)->first());
    }
}   
