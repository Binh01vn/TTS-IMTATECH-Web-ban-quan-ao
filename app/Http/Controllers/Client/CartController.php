<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        // session()->forget('cart');
        // return redirect()->back();
        // dd(session()->all());
        $product = Product::query()->where([
            'slug' => $request->slug,
            'is_active' => 1
        ])->first();
        if (!isset(session('cart')[$request->slug])) {
            $data = $product->toArray()
                + ['quantityPRDC' => $request->quantity];
            session()->put('cart.' . $request->slug, $data);
        } else {
            $dataCart = session('cart')[$request->slug];
            $dataCart['quantityPRDC'] += $request->quantity;
            session()->put('cart.' . $request->slug, $dataCart);
        }
        // dd(session()->all());
        return redirect()->route('cart.shopCart')->with(['success' => 'Thêm sản phẩm vào giỏ hàng thành công!']);
    }
    public function shopCart()
    {
        if (session()->has('cart')) {
            $shopCart = session('cart');
            $this->totalAmount($shopCart);
        }
        return view('client.main-contents.shopProduct.cartPrd');
    }
    public function delOneCart(string $slug)
    {
        if ($slug == 'clearCart') {
            session()->forget('cart');
        } else {
            session()->forget('cart.' . $slug);
        }
        return redirect()->back()->with(['success' => 'Thao tác thành công!']);
    }
    public function checkoutCart()
    {
        $user = Auth::user();
        return view('client.main-contents.shopProduct.checkoutCart', compact('user'));
    }
    public function createOrder(Request $request)
    {
        // dd(session()->all());
        if ($request->payment_method == 'cod') {
            try {
                DB::transaction(function () use ($request) {
                    $user = Auth::user();
                    if (session()->has('cart') && count(session('cart')) > 0) {
                        $shopCart = session('cart');
                        if (!session()->has('totalAmount')) {
                            $this->totalAmount($shopCart);
                        }
                        $totalA = session('totalAmount');
                        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
                        $order = Order::query()->create([
                            'user_id' => $user->id,
                            'user_name' => $request->fullname,
                            'user_email' => $request->email,
                            'user_phone' => $request->phone_number,
                            'user_address' => $request->address,
                            'user_note' => $request->note,
                            'status_order' => Order::STATUS_ORDER['pending'],
                            'payment' => Order::STATUS_PAYMENT['unpaid'],
                            'total_price' => $totalA,
                            'date_create_order' => $now,
                        ]);
                        foreach ($shopCart as $keyCart => $valueCart) {
                            OrderItem::query()->create([
                                'order_id' => $order->id,
                                'product_id' => $valueCart['id'],
                                'quantity' => $valueCart['quantityPRDC'],
                                'product_name' => $valueCart['name'],
                                'product_sku' => $valueCart['sku'],
                                'product_img_thumbnail' => $valueCart['image_thumbnail'],
                                'product_price_regular' => $valueCart['price_default'],
                                'product_price_sale' => $valueCart['price_sale'],
                                'product_sale_discount' => $valueCart['sale_percent'],
                            ]);
                        }
                    }
                });
                session()->forget('cart');
                session()->forget('totalAmount');
                return redirect()->route('dashboard.index')->with(['success' => 'Đặt hàng thành công!']);
            } catch (\Exception $exception) {
                dd($exception);
                return redirect()->back();
            }
        }
    }
    public function totalAmount($shopCart)
    {
        $total = 0;
        foreach ($shopCart as $item) {
            $quantity = $item['quantityPRDC'];
            $priceFinal = $item['sale_percent'] > 0 ? $item['price_default'] * (1 - $item['sale_percent'] / 100) : ($item['price_sale'] > 0 ? $item['price_sale'] : $item['price_default']);
            $total += $quantity * $priceFinal;
        }
        session()->put('totalAmount', $total);
    }
}
