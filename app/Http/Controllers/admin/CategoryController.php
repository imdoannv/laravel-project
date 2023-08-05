<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    const OBJECT = 'admin.categories';
    const DOT = '.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::query()->latest()->paginate();


        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('categories.create');
        return view(self::OBJECT . self::DOT . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreCategoryRequest $request)
    {
        try {
            $model = new Category();

            $model->fill($request->except('image'));

            if ($request->hasFile('image')) {
                $model->image = upload_file(OBJECT_CATEGORIES, $request->file('image'));
            }

            $model->save();

            return redirect()->route('categories.index')
                ->with('status', Response::HTTP_OK)
                ->with('msg', 'Thao tác thành công!');
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return back()
                ->with('status', Response::HTTP_BAD_REQUEST)
                ->with('msg', 'Thao tác thất bại!');
        }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::OBJECT . self::DOT . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Category::query()->findOrFail($id);

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( EditCategoryRequest $request, string $id)
    {
        $model = Category::query()->findOrFail($id);
        $data = $request->except('image');
        $model->fill($request->except('image'));
        $data['image'] = $request->hasFile('image') ? upload_file(OBJECT_CATEGORIES, $request->file('image')) : $model -> image;
        $model->fill($data);
        $model->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        try {
            // Lấy danh sách các sản phẩm thuộc về category đang bị xóa
            $products = Product::where('category_id', $category->id)->get();

                delete_file($category->image);

            // Cập nhật thuộc tính category_id của các sản phẩm thành 'unknown'
            foreach ($products as $product) {
                $product->category_id = 24;
                $product->save();
            }

            // Xóa category
            $category->delete();

            return back()->with('status', Response::HTTP_OK)->with('msg', 'Xóa thành công!');
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return back()->with('status', Response::HTTP_BAD_REQUEST)->with('msg', 'Xóa thất bại!');
        }
    }
}
