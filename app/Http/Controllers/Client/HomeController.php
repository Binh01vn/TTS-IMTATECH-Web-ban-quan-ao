<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::query()->where(['status' => 1])->with('category')->limit(15)->get();
        return view('client.home.index', compact('products'));
    }
}
