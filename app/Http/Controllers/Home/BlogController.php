<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();

        return view("admin.blogs.blogs_all", compact("blogs"));
    }

    public function AddBlog()
    {
        return view("admin.blogs.blogs_add");
    }
}
