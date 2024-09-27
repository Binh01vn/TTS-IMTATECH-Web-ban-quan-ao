<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

class DashboardAccountController extends Controller
{
    public function dashboardAccount()
    {
        $user = Auth::user();
        return view('client.main-contents.accountDashBoard.dashBoard', compact('user'));
    }
    public function listOrders()
    {
        $user = Auth::user();
        $orders = Order::query()->where('user_id', $user->id)->get();
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        return view('client.main-contents.accountDashBoard.orders', compact('orders', 'statusOrder', 'statusPayment'));
    }
    public function detailOrder(string $id)
    {
        $order = Order::query()->where(['id' => $id])->first();
        if (Auth::user()->id != $order->user_id) {
            $failAttempts = session()->get('failed_403_attempts', 0);
            $failAttempts++;
            session()->put('failed_403_attempts', $failAttempts);
            if ($failAttempts >= 5) {
                Auth::logout();
                session()->forget('failed_403_attempts');
                return redirect()->route('auth.login')->withErrors(['message' => 'Bạn đã bị đăng xuất do truy cập không hợp lệ quá nhiều lần.']);
            }
            return abort(403, 'Bạn không có quyền truy cập vào đơn hàng này.');
        }
        return view('client.main-contents.accountDashBoard.orderDetail', compact('order'));
    }
    public function updateStatus(string $id)
    {
        $order = Order::query()->findOrFail($id);
        if ($order->status_order == 'Đã giao hàng' && $order->status_order != 'Đơn hàng bị hủy' && $order->payment == 'Chưa thanh toán') {
            $order->update([
                'payment' => Order::STATUS_PAYMENT['paid'],
                'status_order' => Order::STATUS_ORDER['received']
            ]);
        }
        if ($order->status_order == 'Đã giao hàng' && $order->status_order != 'Đơn hàng bị hủy' && $order->payment == 'Đã thanh toán') {
            $order->update([
                'status_order' => Order::STATUS_ORDER['received']
            ]);
        }
        return redirect()->back()->with(['success' => 'Cập nhật đơn hàng thành công!']);
    }
}
