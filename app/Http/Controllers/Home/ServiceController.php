<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function AllService()
    {
        return view("admin.service_page.service_all");
    }

    public function AddService()
    {
        return view("admin.service_page.service_add");
    }
}
