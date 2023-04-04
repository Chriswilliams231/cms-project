<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FooterController extends Controller
{
    // Mehtod to Route you to the Footer page
    public function FooterSetup()
    {
        $allfooter = Footer::find(1);
        return view("admin.footer.footer_all", compact("allfooter"));
    }

    // Method that updates the footer table with the requested params
    public function UpdateFooter(Request $request): RedirectResponse
    {
        $footer_id = $request->id;

        Footer::findOrFail($footer_id)->update([
            "number" => $request->number,
            "short_description" => $request->short_description,
            "address" => $request->address,
            "email" => $request->email,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "copyright" => $request->copyright,
        ]);
        $notification = [
            "message" => "Footer Updated Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }
}
