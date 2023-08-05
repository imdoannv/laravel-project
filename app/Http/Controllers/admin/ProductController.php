<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    const OBJECT = 'admin.products';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    private function uploadImage(Request $request, string $inputName)
    {
        if ($request->hasFile($inputName)) {
            $imagePath = $request->file($inputName)->store('images');
            return $imagePath;
        }
        return null;
    }

    private function deleteImage(Product $product)
    {
        $images = Image::where('product_id', $product->id)->first();

        if ($images) {
            // Xóa tập tin ảnh từ storage nếu tồn tại
            if ($images->img1) {
                Storage::delete($images->img1);
            }
            if ($images->img2) {
                Storage::delete($images->img2);
            }
            if ($images->img3) {
                Storage::delete($images->img3);
            }

            // Xóa bản ghi ảnh từ cơ sở dữ liệu
            $images->delete();
        }
    }


    public function index() :View
    {
        $data = Product::query()->with(['images','category','size'])->latest()->paginate();

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view (self::OBJECT . self::DOT . __FUNCTION__, compact(['categories','sizes']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $model = new Product();

        $model->fill($request->except(['img1','img2','img3']));

        $model->save();

        // Kiểm tra và xử lý giá trị của $request->file('img1')
        if ($request->hasFile('img1')) {
            $img1 = upload_file(OBJECT_PRODUCTS, $request->file('img1'));
        } else {
            $img1 = 'images/default_image.jpg'; // Nếu không có tệp tin được gửi lên, đặt giá trị mặc định cho img1
        }

        // Kiểm tra và xử lý giá trị của $request->file('img2')
        $img2 = $request->file('img2') ? upload_file(OBJECT_PRODUCTS, $request->file('img2')) : null;

        // Kiểm tra và xử lý giá trị của $request->file('img3')
        $img3 = $request->file('img3') ? upload_file(OBJECT_PRODUCTS, $request->file('img3')) : null;

        Image::create([
            'product_id' => $model->id,
            'img1' => $img1,
            'img2' => $img2,
            'img3' => $img3,
        ]);

        return redirect()->route('products.index');
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
        $categories = Category::all();
        $sizes = Size::all();
        $data = Product::query()->findOrFail($id);
        return view(self::OBJECT . self::DOT . __FUNCTION__,compact(['data','categories','sizes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cập nhật bản ghi trong cơ sở dữ liệu
        $product = Product::query()->findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->descrip = $request->input('descrip');
        $product->category_id = $request->input('category_id');
        $product->size_id = $request->input('size_id');

        $product->save();

        $images = Image::where('product_id', $product->id)->first();
        if ($images) {
            $img1 = $this->uploadImage($request, 'img1');
            $img2 = $this->uploadImage($request, 'img2');
            $img3 = $this->uploadImage($request, 'img3');

            // Cập nhật đường dẫn ảnh mới nếu có
            if ($request->hasFile('img1')) {
                $images->img1 = $img1;
            }
            if ($request->hasFile('img2')) {
                $images->img2 = $img2;
            }
            if ($request->hasFile('img3')) {
                $images->img3 = $img3;
            }

            $images->save();
        }

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $this->deleteImage($product);
        $product->delete();
        return back();
    }
}
