<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;

class BlogCategoryController extends Controller
{
    // Route Method that list all blog Category Name
    public function BlogCategoryAll()
    {
        $blog = BlogCategory::latest()->get();
        return view("admin.blog_category.blog_category_all", compact("blog"));
    }

    // Route Method to the Add a Category Name
    public function AddBlogCategory()
    {
        return view("admin.blog_category.blog_category_add");
    }

    // Route Method that will store the blog data to the blog_categories table
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
