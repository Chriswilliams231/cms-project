<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Contact()
    {
        return view("frontend.contact");
    }

    public function StoreMessage(Request $request): RedirectResponse
    {
        Contact::insert([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "phone" => $request->phone,
            "message" => $request->message,
        ]);
        $notification = [
            "message" => "Your message has been sent!",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }
}
