<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::with('roles')->paginate(15);
//        dd($users);
        return view('users.index',compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $pwd = bcrypt($request->password);
        dd($pwd);
        $instance = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $pwd
        ]);

        if($instance){
            return redirect()->back()->with('callback', '新增成功');
        }else{
            //还是 throw new E?
            return redirect()->back()->withErrors('新增失败，请重试');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 修改邮箱及手机
     * method: post
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function editInfo(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $re = $user->update([
            'name'=> $request->name,
           'email'=> $request->email,
           'phone'=>$request->phone,
        ]);

        if($re){
            return redirect()->back()->with('callback', "修改成功， 目前姓名为{$request->name}，邮箱为{$request->email}，手机为{$request->phone}");
        }
        else{
            return redirect()->back()->withErrors( '修改失败');
        }

    }

    /**
     * 更改密码
     * method : post
     * @param UserRequest $request
     */
    public function editPassword(UserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        //验证旧密码
        if(Hash::check($request->password_o,$user->password)){
            //更新密码
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->back()->with('callback', '修改密码成功, 请牢记的您的密码');
        }
        return redirect()->back()->withErrors( '原密码错误');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        switch ($request->role){
            case 999:
                $user->roles()->detach();
                break;
            default:
                $collection = collect($request->role);
                $user->roles()->sync($collection);
                break;
        }

        return redirect()->back()->withErrors('更新成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::transaction(function ()use ($user){
            //todo 解除权限操作
            $user->roles()->detach();
            //todo 正式删除用户
            $user->delete();
        });

        return redirect()->back()->withErrors('删除成功');
    }

    /**
     * 重置密码
     */
    public function reset($id)
    {
        User::findOrFail($id)->update([
            'password' => bcrypt('666666')
        ]);
        return redirect()->back()->with('callback','成功，重置密码为666666');
    }

    /**
     * 检索用户
     */
    public function selectUsers(Request $request)
    {
        $name = $request->username;

        if($role_id = $request->userrole){
            $users = Role::findOrFail($role_id)->users()->where('name', 'like', "%{$name}%")->with('roles')->paginate(15);
        }else{
            $users = User::where('name', 'like', "%{$name}%")->with('roles')->paginate(15);
        }

        $roles = Role::all();
        return view('users.index',compact('users', 'roles'));
    }

}
