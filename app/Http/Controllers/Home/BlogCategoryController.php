<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;

class BlogCategoryController extends Controller
{
    public function BlogCategoryAll()
    {
        $blog = BlogCategory::latest()->get();
        return view("admin.blog_category.blog_category_all", compact("blog"));
    }

    public function AddBlogCategory()
    {
        return view("admin.blog_category.blog_category_add");
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate(
            [
                "blog_category" => "required",
            ],
            [
                "blog_category.required" => " Blog Category Name is Required",
            ]
        );

        BlogCategory::insert([
            "blog_category" => $request->blog_category,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Blog Category Inserted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->route("all.blog.category")
            ->with($notification);
    }
}
