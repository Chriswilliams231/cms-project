<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use App\Models\About;
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
}
