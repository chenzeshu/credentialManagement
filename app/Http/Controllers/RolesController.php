<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Credentials\AdminParent;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends AdminParent
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('users')->with('perms')->paginate(15);
        $perms = Permission::all();
        return view('roles.index',compact('roles','perms'));
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
    public function store(Request $request)
    {
        DB::transaction(function () use ($request){
           $role =  Role::create([
                'name' => $request->name,
                "display_name" => $request->display_name,
                "description" => $request->description,
            ]);
            if($request->perms){
                $role->savePermissions($request->perms);
            }
        });

        return redirect()->back()->withErrors('新增成功');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        DB::transaction(function () use ($role, $request){
            $role->save();
            $role->savePermissions($request->perms);
        });

        return redirect()->back()->withErrors('修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        //相当于admin这个角色永不能被删除
        if($role->name !=='admin'){
            $role->delete();
        }

        return redirect()->back()->withErrors('删除成功');
    }
}
