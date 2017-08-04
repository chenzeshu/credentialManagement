<?php

namespace App\Http\Controllers\Credentials;

use App\credential_5;
use App\Repositories\CredentialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class Credential5sController extends QParent
{
    protected $repo;

    function __construct(CredentialRepository $repo)
    {
        parent::__construct();
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials = credential_5::orderBy('id', 'desc')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        return view('quality.index',compact('credentials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $this->repo->storeFile($request, 'credentials_5');
        $re = $this->repo->storeData($request, 'credential_5', $path);
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
        $credential_5 = credential_5::find($id);
        $path = unserialize($credential_5->path);
        $path = $this->repo->storeFile($request, 'credential_5', $path);
        $re = $this->repo->updateDate($request, $credential_5, $path);

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
        $credential =  credential_5::find($id);
        //todo 删除文件
        $this->repo->removeFile($credential);
        //todo 删除数据
        $re = $credential->delete();
        if($re){
            return Redirect::back()->with('callback', '删除成功!');
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
        $credential = credential_5::find($request->id);
        return $this->repo->AJAXremoveFile($credential, $request->key);
    }
}
