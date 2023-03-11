<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        $homeslide = HomeSlide::find(1);
        return view("admin.home_slide.home_slide_all", compact("homeslide"));
    }

    // Method to Update the User Home Slide
    public function updateSlider(Request $request): RedirectResponse
    {
        $slide_id = $request->id;

        if ($request->file("home_slide")) {
            $image = $request->file("home_slide");
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension();

            Image::make($image)
                ->resize(636, 852)
                ->save("upload/home_slides/" . $name_gen);
            $save_url = "upload/home_slides/" . $name_gen;

            HomeSlide::findOrFail($slide_id)->update([
                "title" => $request->title,
                "short_title" => $request->short_title,
                "video_url" => $request->video_url,
                "home_images" => $save_url,
            ]);

            $notification = [
                "message" => "Home Slide Updated Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->back()
                ->with($notification);
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                "title" => $request->title,
                "short_title" => $request->short_title,
                "video_url" => $request->video_url,
            ]);

            $notification = [
                "message" => "Home Slide Updated Successfully Without a Image",
                "alert-type" => "success",
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
