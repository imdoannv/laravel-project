<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const OBJECT = 'admin.roles';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $data = Role::query()->latest()->paginate();

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
    public function store(StoreRoleRequest $request)
    {
        $model = new Role();
        $model -> fill($request->all());
        $model->save();

        return redirect()->route('roles.index');
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
        $data = Role::findOrFail($id);
        return view(self::OBJECT . self::DOT . __FUNCTION__,compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRoleRequest $request, string $id)
    {

        // Lấy dữ liệu từ request
        $data = $request->all();

        // Lưu trữ giá trị của các trường vào biến
        $name = $data['name'];

        // Cập nhật bản ghi trong cơ sở dữ liệu
        $role = Role::findOrFail ($id);
        $role->name = $name;
        $role->save();

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return back();
    }
}
