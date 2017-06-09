<?php

namespace App\Http\Controllers;

use App\Patent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PatentsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:maintaince')->only(['store', 'update', 'destroy', 'download', 'deleteFile']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patents = Patent::orderBy('id', 'desc')->paginate(15);
        foreach ($patents as $patent){
            $patent->path = unserialize($patent->path);
        }
        return view('patents.index',compact('patents'));
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
        $path = [];
        if($request->hasFile('path')){
            $files = $request->file('path');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path[$name] = Storage::putFileAs('public/patents', $file, $name);
            }
        }

        $path = serialize($path);
        $re = Patent::create([
            'name'=>$request->name,
            'id1'=>$request->id1,
            'id2'=>$request->id2,
            'type'=>$request->type,
            'time_apply'=>$request->time_apply,
            'time_start'=>$request->time_start,
            'time_authorize'=>$request->path_authorize,
            'time_end'=>$request->time_end,
            'time_end_year'=>$request->time_end_year,
            'path'=>$path,
            'remark'=>$request->remark
        ]);
        if($re){
            return Redirect::back()->with('callback', '新增成功!');
        }else{
            return Redirect::back()->withErrors('新增失败,请重试');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patent = Patent::find($id);
        $path = unserialize($patent->path);
        if($request->hasFile('path')){
            $files = $request->file('path');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path[$name] = Storage::putFileAs('public/patents', $file, $name);
            }
        }

        $path = serialize($path);

        $re = Patent::find($id)->update([
            'name'=>$request->name,
            'id1'=>$request->id1,
            'id2'=>$request->id2,
            'type'=>$request->type,
            'time_apply'=>$request->time_apply,
            'time_start'=>$request->time_start,
            'time_authorize'=>$request->path_authorize,
            'time_end'=>$request->time_end,
            'time_end_year'=>$request->time_end_year,
            'path'=>$path,
            'remark'=>$request->remark
        ]);

        if($re){
            return Redirect::back()->with('callback', '修改成功!');
        }else{
            return Redirect::back()->withErrors('修改失败,请重试');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patent =  Patent::find($id);
        if(!empty($patent->path)){
            $path = unserialize($patent->path);
            foreach ($path as $v){
                Storage::delete($v);
            }
        }

        $re =$patent->delete();
        if($re){
            return Redirect::back()->with('callback', '删除成功');
        }else{
            return Redirect::back()->withErrors('删除失败');
        }

    }

    public function download($path)
    {
        return response()->download(storage_path('app/'.urldecode($path)));
    }

    public function deleteFile(Request $request)
    {
        Storage::delete($request->path);
        $credential = patent::find($request->id);
        $_path = $credential->path;
        $_path = unserialize($_path);
        //todo 找到这个删的path所在的key,删去,并重新序列化保存(这个时候非常怀念nosql的hashmap)
        unset($_path[$request->key]);
        $credential->update([
            'path'=>serialize($_path)
        ]);
        return $data = [
            'data'=>'删除成功'
        ];
    }
}
