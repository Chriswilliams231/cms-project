<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

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
    public function StorePortfolio()
    {
    }
}
