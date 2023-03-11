<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\About;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function aboutPage()
    {
        $aboutpage = About::find(1);
        return view("admin.about_page.about_page_all", compact("aboutpage"));
    }
}
