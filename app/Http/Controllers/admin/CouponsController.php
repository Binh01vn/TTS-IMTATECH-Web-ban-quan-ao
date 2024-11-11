<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoupons;
use App\Http\Requests\UpdateCoupons;
use App\Models\Coupons;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index()
    {
        $data = Coupons::query()->paginate(10);
        return view('admin.coupons.list', compact('data'));
    }
    public function add()
    {
        $type_discount = Coupons::DISCOUNT_TYPE;
        return view('admin.coupons.add-coupon', compact('type_discount'));
    }
    public function store(StoreCoupons $request)
    {
        try {
            DB::beginTransaction();
            Coupons::query()->create(
                [
                    'name' => $request->name,
                    'code' => $request->code,
                    'description' => $request->description ??= 'Chưa cập nhật mô tả cho sản phẩm',
                    'discount_type' => Coupons::DISCOUNT_TYPE[$request->discount_type],
                    'discount_amount' => $request->discount_amount,
                    'minimum_spend' => $request->minimum_spend,
                    'maximum_spend' => $request->maximum_spend,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'quantity' => $request->quantity,
                    'status_coupon' => $request->status_coupon ??= 0,
                ]
            );
            DB::commit();
            return redirect()->route('admin.coupons.list_mkm')->with('success', 'Thêm 1 mã khuyến mại thành công!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function show(string $id)
    {
        $data = Coupons::query()->findOrFail($id);
        $type_discount = Coupons::DISCOUNT_TYPE;
        return view('admin.coupons.detail-coupon', compact('data', 'type_discount'));
    }
    public function edit(string $id)
    {
        $data = Coupons::query()->findOrFail($id);
        $type_discount = Coupons::DISCOUNT_TYPE;
        return view('admin.coupons.edit-coupon', compact('data', 'type_discount'));
    }
    public function update(UpdateCoupons $request, Coupons $coupon)
    {
        try {
            DB::beginTransaction();
            $coupon->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description ??= 'Chưa cập nhật mô tả cho sản phẩm',
                'discount_type' => Coupons::DISCOUNT_TYPE[$request->discount_type],
                'discount_amount' => $request->discount_amount,
                'minimum_spend' => $request->minimum_spend,
                'maximum_spend' => $request->maximum_spend,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'quantity' => $request->quantity,
                'status_coupon' => $request->status_coupon ??= 0,
            ]);
            DB::commit();
            return redirect()->route('admin.coupons.list_mkm')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }
    public function delete(Coupons $coupon)
    {
        if ($coupon->delete()) {
            return redirect()->route('admin.coupons.list_mkm')->with('success', 'Xóa mã khuyến mại thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa mã khuyến mại thất bại!');
        }
    }
}
