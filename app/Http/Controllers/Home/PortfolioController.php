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

    // Route Method to the Edit Page
    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view(
            "admin.portfolio_page.portfolio_edit",
            compact("portfolio")
        );
    }

    // Route Method for updating the portfolio data
    public function UpdatePortfolio(Request $request): RedirectResponse
    {
        $portfolio_id = $request->id;

        if ($request->file("portfolio_image")) {
            $image = $request->file("portfolio_image");
            $name_gen =
                hexdec(uniqid()) . "." . $image->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($image)
                ->resize(1020, 519)
                ->save("upload/portfolio/" . $name_gen);
            $save_url = "upload/portfolio/" . $name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                "portfolio_name" => $request->portfolio_name,
                "portfolio_title" => $request->portfolio_title,
                "portfolio_description" => $request->portfolio_description,
                "portfolio_image" => $save_url,
            ]);
            $notification = [
                "message" => "Portfolio Updated with Image Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->back()
                ->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                "portfolio_name" => $request->portfolio_name,
                "portfolio_title" => $request->portfolio_title,
                "portfolio_description" => $request->portfolio_description,
            ]);
            $notification = [
                "message" => "Portfolio Updated without Image Successfully",
                "alert-type" => "success",
            ];

            return redirect()
                ->route("portfolio.page")
                ->with($notification);
        }
    }

    // Route Method to Delete
    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);

        Portfolio::findOrFail($id)->delete();

        $notification = [
            "message" => "Portfolio Image Deleted Successfully",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }

    // Route Method to show all the data for the frontend
    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view("frontend.portfolio_details", compact("portfolio"));
    }

    public function HomePortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view("frontend.portfolio", compact("portfolio"));
    }
}
