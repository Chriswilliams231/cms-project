<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function PortfolioPage()
    {
        $portfolio = Portfolio::latest()->get();
        return view("admin.portfolio_page.portfolio_all", compact("portfolio"));
    }
}
