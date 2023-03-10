<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Nette\Utils\Image;

class HomeSliderController extends Controller
{
    public function homeSlider() {
       
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }

    public function updateSlider(Request $request){
        $slide_id = $request->id;

        if($request->file('home_slide')){
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()). '.'.$image->getClientOriginalExtension();
            
        }
    }
}