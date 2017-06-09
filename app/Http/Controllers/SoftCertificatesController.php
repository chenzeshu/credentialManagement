<?php

namespace App\Http\Controllers;

use App\SoftCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SoftCertificatesController extends Controller
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
        $softs = SoftCertificate::orderBy('id', 'desc')->paginate(15);
        foreach ($softs as $soft){
            $soft->path_auth = unserialize($soft->path_auth);
            $soft->path_soft = unserialize($soft->path_soft);
        }
        return view('softs.index',compact('softs'));
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
        $path_auth = [];
        $path_soft = [];

        if($request->hasFile('path_auth')){
            $files = $request->file('path_auth');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path_auth[$name] = Storage::putFileAs('public/softs', $file, $name);
            }
        }
        if($request->hasFile('path_soft')){
            $files = $request->file('path_soft');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path_soft[$name] = Storage::putFileAs('public/softs', $file, $name);
            }
        }

        $path_auth = serialize($path_auth);
        $path_soft = serialize($path_soft);

        $re = SoftCertificate::create([
            'name'=>$request->name,
            'id1'=>$request->id1,
            'type'=>$request->type,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'path_auth'=>$path_auth,
            'path_soft'=>$path_soft,
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
        $patent = SoftCertificate::find($id);
        $path_auth = unserialize($patent->path_auth);
        $path_soft = unserialize($patent->path_soft);
        //todo 没有做文件重复上传校验,不过因为key已经被做好了,所以失败一定是文件名重复!
        //todo 有时间可以为文件名重复做一个错误提醒
        if($request->hasFile('path_auth')){
            $files = $request->file('path_auth');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path_auth[$name] = Storage::putFileAs('public/softs', $file, $name);
            }
        }
        if($request->hasFile('path_soft')){
            $files = $request->file('path_soft');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path_soft[$name] = Storage::putFileAs('public/softs', $file, $name);
            }
        }

        $path_auth = serialize($path_auth);
        $path_soft = serialize($path_soft);

        $re = SoftCertificate::find($id)->update([
            'name'=>$request->name,
            'id1'=>$request->id1,
            'type'=>$request->type,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'path_auth'=>$path_auth,
            'path_soft'=>$path_soft,
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
        $soft =  SoftCertificate::find($id);
        if(!empty($soft->path_auth)){
            $path = unserialize($soft->path);
            foreach ($path as $v){
                Storage::delete($v);
            }
        }
        if(!empty($soft->path_soft)){
            $path = unserialize($soft->path_soft);
            foreach ($path as $v){
                Storage::delete($v);
            }
        }
        $re = $soft->delete();
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
        $soft = SoftCertificate::find($request->id);
        $_path_auth = $soft->path_auth;
        $_path_soft = $soft->path_soft;
        $_path_auth = unserialize($_path_auth);
        $_path_soft = unserialize($_path_soft);

        //todo 找到这个删的path所在的key,删去,并重新序列化保存(这个时候非常怀念nosql的hashmap)
        if(in_array($request->path, $_path_auth)){
            unset($_path_auth[$request->key]);
            $soft->update([
                'path_auth'=>serialize($_path_auth)
            ]);
        }else{
            unset($_path_soft[$request->key]);
            $soft->update([
                'path_soft'=>serialize($_path_soft)
            ]);
        }
        return $data = [
            'data'=>'删除成功'
        ];
    }
}
