<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\ModelsImage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImageController extends Controller
{
    const OBJECT = 'admin.images';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $data = Image::all();

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
        $model = new Image();
        $model -> fill($request->all());
        $model->save();

        return redirect()->route('images.index');
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
        $data = Image::findOrFail($id);
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
        $product_id = $data['product_id'];
        $img1 = $data['img1'];
        $img2 = $data['img2'];
        $img3 = $data['img3'];

        // Cập nhật bản ghi trong cơ sở dữ liệu
        $image = Image::findOrFail ($id);
        $image-> product_id = $product_id;
        $image->img1 = $img1;
        $image->img2 = $img2;
        $image->img3 = $img3;
        $image->save();

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
        $image->delete();
        return back();
    }
}
