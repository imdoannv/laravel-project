<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
class CartController extends Controller
{
    const OBJECT = 'customer.cart';
    const DOT = '.';

    public function store(Request $request)
    {
        $user_id = auth()->id();
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng hay chưa
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng của nó
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, tạo bản ghi mới
            $cartItem = new CartItem([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
            $cartItem->save();
        }

        return back();
    }

    public function index()
    {
        $user = auth()->user();

        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product') // Để lấy thông tin chi tiết của sản phẩm từ bảng products
            ->get();

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('cartItems'));
    }

    public function destroy($product_id)
    {
        $user = auth()->user();
        $user_id = $user->id;

        // Tìm sản phẩm trong giỏ hàng của người dùng
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Xóa sản phẩm trong giỏ hàng
            $cartItem->delete();

            // Trả về JSON response cho Ajax request để xác nhận xóa thành công
            return response()->json(['message' => 'Product removed from cart successfully.'], 200);
        } else {
            // Trả về JSON response cho Ajax request để thông báo không tìm thấy sản phẩm trong giỏ hàng
            return response()->json(['message' => 'Product not found in your cart.'], 404);
        }
    }
}
