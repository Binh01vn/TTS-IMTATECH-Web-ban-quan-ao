<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function AboutUs()
    {
        return view('client.other-pages.about-us');
    }
    public function ContactUs()
    {
        return view('client.other-pages.contact-us');
    }
}
