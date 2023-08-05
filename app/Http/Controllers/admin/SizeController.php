<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditSizeRequest;
use App\Http\Requests\StoreSizeRequest;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const OBJECT = 'admin.sizes';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $data = Size::query()->latest()->paginate();

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
    public function store(StoreSizeRequest $request)
    {
        $model = new Size();
        $model -> fill($request->all());
        $model->save();

        return redirect()->route('sizes.index');
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
        $data = Size::findOrFail($id);
        return view(self::OBJECT . self::DOT . __FUNCTION__,compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSizeRequest $request, string $id)
    {

        // Lấy dữ liệu từ request
        $data = $request->all();

        // Lưu trữ giá trị của các trường vào biến
        $name = $data['name'];

        // Cập nhật bản ghi trong cơ sở dữ liệu
        $size = Size::findOrFail ($id);
        $size->name = $name;
        $size->save();

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            // Lấy danh sách các sản phẩm thuộc về size đang bị xóa
            $products = Product::where('size_id', $size->id)->get();

            // Cập nhật thuộc tính size_id của các sản phẩm thành 'unknown'
            foreach ($products as $product) {
                $product->size_id = 9;
                $product->save();
            }

            // Xóa size
            $size->delete();

            return back()->with('status', Response::HTTP_OK)->with('msg', 'Xóa thành công!');
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return back()->with('status', Response::HTTP_BAD_REQUEST)->with('msg', 'Xóa thất bại!');
        }
    }
}
