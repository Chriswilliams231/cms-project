<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    public function AllService()
    {
        $services = Service::latest()->get();
        return view("admin.service_page.service_all", compact("services"));
    }

    public function AddService()
    {
        return view("admin.service_page.service_add");
    }

    public function StoreService(Request $request): RedirectResponse
    {
        $request->validate(
            [
                "title" => "required",
                "short_title" => "required",
                "service_image" => "required",
            ],
            [
                "title.required" => "Service Title is Required",
                "short_title.required" => "Service Short Title is Required",
                "service_image.required" => "Service Image is Required",
            ]
        );

        $image = $request->file("service_image");
        $name_gen =
            hexdec(uniqid()) . "." . $image->getClientOriginalExtension(); // 3434343443.jpg

        Image::make($image)
            ->resize(850, 430)
            ->save("upload/service/" . $name_gen);
        $save_url = "upload/service/" . $name_gen;

        Service::insert([
            "title" => $request->title,
            "short_title" => $request->short_title,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "service_points" => $request->service_points,
            "service_image" => $save_url,
            "created_at" => Carbon::now(),
        ]);
        $notification = [
            "message" => "Services Inserted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->route("service.all")
            ->with($notification);
    }
}
