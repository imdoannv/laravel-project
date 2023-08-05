<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Items_order;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    const OBJECT = 'admin.orders';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $data = Order::query()->with('user')->with('orderItems')->get();


        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view (self::OBJECT . self::DOT . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Items_order::query()->with('order')->with('product')->where('order_id',$id)->get();
        $user = User::query()->where('id', $data[0]->order->user_id)->first();
        return view(self::OBJECT . self::DOT . 'detail', compact('data','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Order::findOrFail($id);
        return view(self::OBJECT . self::DOT . __FUNCTION__,compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // Lấy dữ liệu từ request
        $data = $request->all();

        // Lưu trữ giá trị của các trường vào biến
        $name = $data['name'];
        $image = $data['image'];

        // Cập nhật bản ghi trong cơ sở dữ liệu
        $order = Order::findOrFail ($id);
        $order->name = $name;
        $order->image = $image;
        $order->save();

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return back();
    }
}
