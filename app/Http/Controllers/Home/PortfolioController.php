<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{
    // Route Method to veiw all the data for the portfolio page
    public function PortfolioPage()
    {
        $portfolio = Portfolio::latest()->get();
        return view("admin.portfolio_page.portfolio_all", compact("portfolio"));
    }

    // Route Method to add data to the portfolio
    public function AddPortfolio()
    {
        return view("admin.portfolio_page.portfolio_add");
    }

    // Route Method to store portfolio data
    public function StorePortfolio(Request $request): RedirectResponse
    {
        $request->validate(
            [
                "portfolio_name" => "required",
                "portfolio_title" => "required",
                "portfolio_image" => "required",
            ],
            [
                "portfolio_name.required" => " Portfolio Name is Required",
                "portfolio_title.required" => " Portfolio Title is Required",
            ]
        );
        $image = $request->file("portfolio_image");
        $name_gen =
            hexdec(uniqid()) . "." . $image->getClientOriginalExtension();

        Image::make($image)
            ->resize(1020, 519)
            ->save("upload/portfolio/" . $name_gen);
        $save_url = "upload/portfolio/" . $name_gen;

        Portfolio::insert([
            "portfolio_name" => $request->portfolio_name,
            "portfolio_title" => $request->portfolio_title,
            "portfolio_description" => $request->portfolio_description,
            "portfolio_image" => $save_url,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Portfolio Data Inserted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->route("portfolio.page")
            ->with($notification);
    }
}
