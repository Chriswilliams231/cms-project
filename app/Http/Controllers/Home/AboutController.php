<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);
        return view("admin.about_page.about_page_all", compact("aboutpage"));
    }

    public function UpdateAbout(Request $request): RedirectResponse
    {
        $about_id = $request->id;

        if ($request->file("about_image")) {
            $image = $request->file("about_image");
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension();

            Image::make($image)
                ->resize(523, 605)
                ->save("upload/home_about/" . $name_gen);
            $save_url = "upload/home_about/" . $name_gen;

            About::findOrFail($about_id)->update([
                "title" => $request->title,
                "short_title" => $request->short_title,
                "short_description" => $request->short_description,
                "long_description" => $request->long_description,
                "about_image" => $save_url,
            ]);

            $notification = [
                "message" => "About Page Updated Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->back()
                ->with($notification);
        } else {
            About::findOrFail($about_id)->update([
                "title" => $request->title,
                "short_title" => $request->short_title,
                "short_description" => $request->short_description,
                "long_description" => $request->long_description,
            ]);

            $notification = [
                "message" => "About Page Updated Successfully Without a Image",
                "alert-type" => "success",
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
    // Route Method to the About Page in the fronted
    public function HomeAbout()
    {
        $aboutpage = About::find(1);
        return view("frontend.about_page", compact("aboutpage"));
    }

    // Route Method for the multi image
    public function MultiImage()
    {
        return view("admin.about_page.multimage");
    }

    // Route Method to Store multiple images
    public function StoreImages(Request $request)
    {
        $image = $request->file("multi_image");

        foreach ((array) $image as $multi_image) {
            $name_gen =
                hexdec(uniqid()) .
                "." .
                $multi_image->getClientOriginalExtension();

            Image::make($multi_image)
                ->resize(220, 220)
                ->save("upload/multi_images/" . $name_gen);

            $save_url = "upload/multi_images/" . $name_gen;

            MultiImage::insert([
                "multi_image" => $save_url,
                "created_at" => Carbon::now(),
            ]);
        }

        $notification = [
            "message" => "Multi Image Inserted Successfully",
            "alert-type" => "success",
        ];
        return redirect()
            ->route("all.multi.image")
            ->with($notification);
    }

    // Route Method to View all the images in the multi_image table
    public function AllMultiImage()
    {
        $allMultiImage = MultiImage::all();

        return view(
            "admin.about_page.all_multiimage",
            compact("allMultiImage")
        );
    }

    // Route To the edit page for the images
    public function EditMultiImage($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        return view("admin.about_page.edit_multi_image", compact("multiImage"));
    }

    // POST Method to update the  multiple images stored
    public function UpdateImages(Request $request)
    {
        $images_id = $request->id;

        if ($request->file("multi_image")) {
            $image = $request->file("multi_image");
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension();

            Image::make($image)
                ->resize(220, 220)
                ->save("upload/multi_images/" . $name_gen);

            $save_url = "upload/multi_images/" . $name_gen;

            MultiImage::findOrFail($images_id)->update([
                "multi_image" => $save_url,
                "updated_at" => Carbon::now(),
            ]);

            $notification = [
                "message" => " Image Updated Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->route("all.multi.image")
                ->with($notification);
        }
    }
}
