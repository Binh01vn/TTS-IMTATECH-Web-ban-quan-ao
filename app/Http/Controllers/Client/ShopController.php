<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function addCart(Request $request)
    {
        // dd(session()->all());
        $product = Product::query()->where([
            'slug' => $request->slug,
            'is_active' => 1
        ])->first();
        if (!isset(session('cart')[$request->slug])) {
            $data = $product->toArray()
                + ['quantityPRDC' => number_format((int) $request->quantity, 0, ',', '.')];
            session()->put('cart.' . $request->slug, $data);
            // dd(session('cart'));
        } else {
            $quantityPRDC = session('cart')[$request->slug]['quantityPRDC'];
            
            dd(number_format((int) $quantityPRDC, 0, ',', '.'));
        }
        // dd(session()->all());
        return redirect()->back();
    }
}
