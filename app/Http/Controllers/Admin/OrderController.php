<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrder()
    {
        $dataO = Order::query()->get();
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        return view('admin.contents.Orders.listOrders', compact('dataO', 'statusOrder', 'statusPayment'));
    }
    public function bulkActions(Request $request)
    {
        if ($request->btnApply == 'Apply' && $request->slAction != 'sltNull') {
            if ($request->slAction == 'delete') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->delete();
                }
            }
            if ($request->slAction == 'confirmed') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'status_order' => Order::STATUS_ORDER['confirmed']
                    ]);
                }
            }
            if ($request->slAction == 'preparing_goods') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'status_order' => Order::STATUS_ORDER['preparing_goods']
                    ]);
                }
            }
            if ($request->slAction == 'shipping') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'status_order' => Order::STATUS_ORDER['shipping']
                    ]);
                }
            }
            if ($request->slAction == 'delivered') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'status_order' => Order::STATUS_ORDER['delivered']
                    ]);
                }
            }
            if ($request->slAction == 'paid') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'payment' => Order::STATUS_PAYMENT['paid']
                    ]);
                }
            }
            if ($request->slAction == 'unpaid') {
                foreach ($request->idOrder as $id) {
                    $order = Order::query()->findOrFail($id);
                    $order->update([
                        'payment' => Order::STATUS_PAYMENT['unpaid']
                    ]);
                }
            }
        } else {
            return redirect()->route('admin.orders.list')->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
        return redirect()->route('admin.orders.list')->with(['success' => 'Thao tác thành công!']);
    }

    public function orderDetail(string $id)
    {
        $data = Order::query()->with('items')->findOrFail($id);
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        return view('admin.contents.Orders.detailOrder', compact('data', 'statusOrder', 'statusPayment'));
    }
}
