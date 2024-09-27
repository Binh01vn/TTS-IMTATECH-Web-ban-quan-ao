<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ShopController extends Controller
{
    public function shopIndex()
    {
        $dataPrdAll = Product::query()->where('is_active', 1)->latest('id')->paginate(12);
        return view('client.contents-main.shopProduct.shopIndex', compact('dataPrdAll'));
    }
    public function productDetail(string $slug)
    {
        $dataPrd = Product::query()->where([
            'slug' => $slug,
            'is_active' => 1
        ])->first();
        $prdSimilar = Product::query()->where([
            'is_active' => 1,
            'category_id' => $dataPrd->category_id,
        ])->get();
        // dd($dataPrd);
        return view('client.main-contents.shopProduct.detailPRD', compact('dataPrd', 'prdSimilar'));
    }
}
