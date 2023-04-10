<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class ContactController extends Controller
{
    // Method to the Contact page on the frontend
    public function Contact()
    {
        return view("frontend.contact");
    }

    // Method to store the data that user inputs on the frontend
    public function StoreMessage(Request $request): RedirectResponse
    {
        Contact::insert([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "phone" => $request->phone,
            "message" => $request->message,
            "created_at" => Carbon::now(),
        ]);

        $notification = [
            "message" => "Your message has been sent!",
            "alert-type" => "success",
        ];

        return redirect()
            ->back()
            ->with($notification);
    }

    // Method that recieves the data the user gave within the frontend
    public function ContactMessage()
    {
        $contacts = Contact::latest()->get();

        return view("admin.contacts.allcontacts", compact("contacts"));
    }

    // Method that deletes that data from the dashboard
    public function DeleteContact($id): RedirectResponse
    {
        Contact::findOrFail($id)->delete();

        $notification = [
            "message" => "Your message has been sent!",
            "alert-type" => "success",
        ];
        return redirect()
            ->back()
            ->with($notification);
    }
}
