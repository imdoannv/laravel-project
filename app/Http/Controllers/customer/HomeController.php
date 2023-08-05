<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const OBJECT = 'customer.layout';
    const DOT ='.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); // Lấy tất cả các category
        $data = []; // Khởi tạo mảng chứa thông tin các category và sản phẩm

        foreach ($categories as $category) {
            $categoryName = $category->name;

            // Lấy danh sách sản phẩm thuộc category hiện tại
            $productsInCategory = Product::query()->where('category_id', $category->id)->with('images')->get();

            // Thêm thông tin của category và sản phẩm vào mảng $data
            $data[] = [
                'categoryName' => $categoryName,
                'productsInCategory' => $productsInCategory,
            ];
        }

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $product = Product::with(['images','category','size'])->findOrFail($id);


        // Ví dụ: Lấy các sản phẩm liên quan, bạn có thể thay đổi truy vấn dựa vào yêu cầu của bạn
        $relatedProducts = Product::query()
            ->with(['images','category','size'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Loại bỏ sản phẩm đang xem khỏi danh sách liên quan
            ->limit(4) // Giới hạn số lượng sản phẩm liên quan hiển thị
            ->get();

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('product', 'relatedProducts'));
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
