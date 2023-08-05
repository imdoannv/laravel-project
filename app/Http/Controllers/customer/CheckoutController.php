<?php


namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlaced;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Items_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    const OBJECT = 'customer.checkout';
    const DOT = '.';

    public function index(Request $request)
    {
        // Lấy danh sách sản phẩm được chọn từ form
        $selectedProducts = $request->input('selected_products', []);

        // Tạo một mảng chứa thông tin về giá, tên và số lượng của các sản phẩm được chọn
        $productsData = [];
        foreach ($selectedProducts as $productId) {
            $cartItem = CartItem::where('user_id', auth()->id())
                ->with('product')
                ->where('product_id', $productId)
                ->first();
            if ($cartItem) {
                $productData = [
                    'product_id' => $productId,
                    'price' => $cartItem->product->price,
                    'name' => $cartItem->product->name,
                    'quantity' => $cartItem->quantity,
                ];
                $productsData[] = $productData;
            }
        }

        // Truyền danh sách sản phẩm được chọn và thông tin giá, tên và số lượng vào view Checkout
        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('productsData'));
    }

    public function placeOrder(Request $request){
        //thêm user_id vào bảng order
        $user_id = auth()->id();
        $order = new Order();
        $order->user_id = $user_id;
        $order->save();
        //thêm product_id, quantity, price vào bảng order_item
        $jsonString  = $request->input('productsData');
        $trimmedJsonString = trim($jsonString);
        $selectedProducts = json_decode($trimmedJsonString, true);
        $orderItem = new Items_order();
        foreach ($selectedProducts as $product) {
            $cartItem = CartItem::where('user_id', auth()->id())
                ->with('product')
                ->where('product_id', $product['product_id'])
                ->first();
//            dd($cartItem);
            if ($cartItem) {
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product['product_id'];
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->price = $cartItem->product->price;
                $orderItem->save();
                CartItem::where('user_id', $user_id)->where('product_id',$orderItem->product_id)->delete();
            }
        }
        $userEmail = auth()->user()->email;
        Mail::to($userEmail)->send(new OrderPlaced($orderItem));
        //xóa các sản phẩm đã order khỏi giỏ hàng
        return redirect()->route('checkout.success');
    }
    public function success() {
        return view(self::OBJECT.self::DOT.'success');
    }

}
