<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem; // Thêm import model OrderItem
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lưu thông tin sản phẩm vào bảng 'order_items'
        {
            // Lấy thông tin đơn hàng từ form
            $order = Order::findOrFail($request->input('order_id'));

            // Lấy danh sách sản phẩm từ form (nếu có)
            $productIds = $request->input('product_id', []);
            $prices = $request->input('price', []);
            $quantities = $request->input('quantity', []);

            // Lưu thông tin sản phẩm vào bảng OrderItems
            foreach ($productIds as $index => $productId) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->price = $prices[$index];
                $orderItem->quantity = $quantities[$index];
                // Thêm các trường thông tin khác cần thiết từ sản phẩm vào đây
                $orderItem->save();
            }

            // Redirect hoặc trả về view thông báo đặt hàng thành công
            return redirect()->route('admin.orders.index')->with('success', 'Order placed successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
