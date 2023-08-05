<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    const OBJECT = 'admin.users';
    const DOT = '.';
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $data = User::query()->with('role')->latest()->paginate();

        return view(self::OBJECT . self::DOT . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $roles = Role::all();
        return view (self::OBJECT . self::DOT . __FUNCTION__, compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $model = new User();
        $model -> fill($request->all());
        $model->save();

        return redirect()->route('users.index');
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
        $data = User::query()->findOrFail($id);
        $roles = Role::all();

        return view(self::OBJECT . self::DOT . __FUNCTION__,compact('data','roles'));
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
        $role_id = $data['role_id'];
        $username= $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $address = $data['address'];


        // Cập nhật bản ghi trong cơ sở dữ liệu
        $user = User::findOrFail ($id);
        $user->name = $name;
        $user->role_id = $role_id;
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->address = $address;
        $user->save();

        // Phần code còn lại (chẳng hạn, chuyển hướng sau khi cập nhật)
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return back();
    }
}
