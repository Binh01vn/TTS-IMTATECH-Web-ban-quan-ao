<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Review;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function detail(string $slug)
    {
        $data = Products::query()->where(['slug' => $slug, 'status' => 1])->with(['tags', 'galleries', 'variants'])->first();
        if ($data) {
            $sizes = $data->variants
                ->pluck('size')
                ->flatten(1)->unique('id')->values();
            $colors = $data->variants
                ->pluck('color')
                ->flatten(1)->unique('id')->values();
            $similars = Products::query()->where([
                'status' => 1,
                'categorization_id' => $data->categorization_id,
            ])->get();
            return view('client.shop-contents.product-detail', compact('data', 'sizes', 'colors', 'similars'));
        }
    }
    public function review(Request $request)
    {
        $validator = $request->validate([
            'product_id' => 'required|min:1',
            'rating' => 'nullable|min:1|max:5',
            'comment' => 'string|max:255'
        ]);
        $product = Products::query()->findOrFail($request->product_id);
        if (Auth::user()) {
            $user = Auth::user();
            Review::query()->create([
                'user_id' => $user->id,
                'products_id' => $product->id,
                'user_name' => $user->full_name,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'review_date' => Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i'),
            ]);
        } else {
            return abort(401);
        }
        return redirect()->back()->with(['success' => 'Đăng 1 review thành công!']);
    }
}
