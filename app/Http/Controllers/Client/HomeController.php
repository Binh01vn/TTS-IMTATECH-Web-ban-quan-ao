<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function shopHome()
    {
        $dataProductNew = Product::query()->with('galleries')->where('is_active', '1')->limit(8)->latest('id')->get();
        return view('client.main-contents.home-page.home-content', compact('dataProductNew'));
    }
    public function prdModal(Request $request)
    {
        $slug = $request->prdSlug;
        $modelPRD = Product::query()->with('galleries')->where('slug', $slug)->first();
        return response()->json($modelPRD);
    }
}
