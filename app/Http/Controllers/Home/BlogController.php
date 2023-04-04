<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    // Route Method to view all the blog data
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();

        return view("admin.blogs.blogs_all", compact("blogs"));
    }

    // Method that links the BlogCategory data the add.blog route
    public function AddBlog()
    {
        $categories = BlogCategory::orderBy("blog_category", "ASC")->get();
        return view("admin.blogs.blogs_add", compact("categories"));
    }

    // Method that stores the data into the Blogs table
    public function StoreBlog(Request $request): RedirectResponse
    {
        $image = $request->file("blog_image");
        $name_gen =
            hexdec(uniqid()) . "." . $image->getClientOriginalExtension(); // 3434343443.jpg

        Image::make($image)
            ->resize(430, 327)
            ->save("upload/blog/" . $name_gen);
        $save_url = "upload/blog/" . $name_gen;

        Blog::insert([
            "blog_category_id" => $request->blog_category_id,
            "blog_title" => $request->blog_title,
            "blog_tags" => $request->blog_tags,
            "blog_description" => $request->blog_description,
            "blog_image" => $save_url,
            "created_at" => Carbon::now(),
        ]);
        $notification = [
            "message" => "Blog Inserted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->route("all.blog")
            ->with($notification);
    }

    // Method will send to the edit page with that exact data requested
    public function EditBlog($id)
    {
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy("blog_category", "ASC")->get();
        return view("admin.blogs.blogs_edit", compact("blogs", "categories"));
    }

    // Method to update the data placed within the Blog table
    public function UpdateBlog(Request $request): RedirectResponse
    {
        $blog_id = $request->id;

        if ($request->file("blog_image")) {
            $image = $request->file("blog_image");
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($image)
                ->resize(430, 327)
                ->save("upload/blog/" . $name_gen);
            $save_url = "upload/blog/" . $name_gen;

            Blog::findOrFail($blog_id)->update([
                "blog_category_id" => $request->blog_category_id,
                "blog_title" => $request->blog_title,
                "blog_tags" => $request->blog_tags,
                "blog_description" => $request->blog_description,
                "blog_image" => $save_url,
            ]);
            $notification = [
                "message" => "Blog Updated with Image Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->route("all.blog")
                ->with($notification);
        } else {
            Blog::findOrFail($blog_id)->update([
                "blog_category_id" => $request->blog_category_id,
                "blog_title" => $request->blog_title,
                "blog_tags" => $request->blog_tags,
                "blog_description" => $request->blog_description,
            ]);

            $notification = [
                "message" => "Blog Updated without Image Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->route("all.blog")
                ->with($notification);
        }
    }

    // Mehtod to delete the $id seleted
    public function DeleteBlog($id): RedirectResponse
    {
        $blogs = Blog::findOrFail($id);
        $img = $blogs->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = [
            "message" => "Blog Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }

    // Frontend route to get all the blog details
    public function BlogDetails($id)
    {
        $allblogs = Blog::latest()
            ->limit(5)
            ->get();
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy("blog_category", "ASC")->get();
        return view(
            "frontend.blog_details",
            compact("blogs", "allblogs", "categories")
        );
    }

    /*
     * Method that uses both the Blog and BlogCategory
     * and finds the $id of the specific data selected
     * on the frontend.
     */
    public function CategoryBlog($id)
    {
        $blogpost = Blog::where("blog_category_id", $id)
            ->orderBy("id", "DESC")
            ->get();
        $allblogs = Blog::latest()
            ->limit(5)
            ->get();
        $categories = BlogCategory::orderBy("blog_category", "ASC")->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view(
            "frontend.category_blog_details",
            compact("blogpost", "allblogs", "categories", "categoryname")
        );
    }

    // Method that list all the blogs within the frontends blog page
    public function HomeBlog()
    {
        $categories = BlogCategory::orderBy("blog_category", "ASC")->get();
        $allblogs = Blog::latest()->get();
        return view("frontend.blog", compact("allblogs", "categories"));
    }
}
