<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ColorAttribute;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\SizeAttribute;
use Auth;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function shopIndex()
    {
        $dataPrdAll = Product::query()->where('is_active', 1)->latest('id')->paginate(9);
        $colors = ColorAttribute::query()->get();
        $sizes = SizeAttribute::query()->get();
        return view('client.main-contents.shopProduct.shopIndex', compact('dataPrdAll', 'colors', 'sizes'));
    }
    public function productDetail(string $slug)
    {
        $dataPrd = Product::query()->where([
            'slug' => $slug,
            'is_active' => 1
        ])->first();
        if ($dataPrd) {
            $sizes = $dataPrd->variants
                ->pluck('variantValues.*.sizeAttribute')
                ->flatten(1)->unique('id')->values();
            $colors = $dataPrd->variants
                ->pluck('variantValues.*.colorAttribute')
                ->flatten(1)->unique('id')->values();
            $reviews = Review::where('product_id', $dataPrd->id)->get();
            $averageRating = ceil($reviews->avg('rating'));
            $totalReviews = $reviews->count();
            $prdSimilar = Product::query()->where([
                'is_active' => 1,
                'category_id' => $dataPrd->category_id,
            ])->get();
            return view('client.main-contents.shopProduct.detailPRD', compact(
                'dataPrd',
                'sizes',
                'colors',
                'prdSimilar',
                'averageRating',
                'totalReviews'
            ));
        } else {
            return abort(404);
        }
    }
    public function reviews(Request $request)
    {
        $validator = $request->validate([
            'product_id' => 'min:1',
            'rating' => 'min:1|max:5',
            'comment' => 'string|max:255'
        ]);
        $product = Product::query()->findOrFail($request->product_id);
        $data = [];
        if (Auth::user()) {
            $user = Auth::user();
            $data['user_id'] = $user->id;
            $data['product_id'] = $product->id;
            $data['user_name'] = $user->name;
            $data['rating'] = $request->rating;
            $data['comment'] = $request->comment;
            $data['review_date'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            Review::query()->create($data);
        } else {
            return abort(404);
        }
        return redirect()->back()->with(['success' => 'Đăng 1 review thành công!']);
    }
}
