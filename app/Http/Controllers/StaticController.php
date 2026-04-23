<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    use PhpFlasher;
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

        return redirect()->route('contact.thanks');
    }

    public function contactThanks()
    {
        return view('pages.static.contact-thanks');
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
