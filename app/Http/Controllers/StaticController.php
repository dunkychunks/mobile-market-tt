<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function contact()
    {
        return view('pages.static.contact');
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:200'],
            'body'    => ['required', 'string', 'max:2000'],
        ]);

        Message::create($data);

        flash()->success('Your message has been sent. We will get back to you shortly.');

        return redirect()->route('contact');
    }

    public function about()
    {
        return view('pages.static.about');
    }

    public function privacy()
    {
        return view('pages.static.privacy');
    }

    public function terms()
    {
        return view('pages.static.terms');
    }
}
