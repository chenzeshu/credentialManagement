<?php

namespace App\Http\Controllers;

use App\Histroy_detail;
use App\Repositories\HumanRepository;
use App\Human;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class HumansController extends Controller
{
    protected $repo;

    function __construct(HumanRepository $repo)
    {
        $this->repo = $repo;
        $this->middleware('permission:maintaince')->only(['store', 'update', 'destroy', 'download', 'deleteFile']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $humans = Human::orderBy('id', 'desc')->paginate(15);
        foreach ($humans as $human){
            $human->path_i  = unserialize($human->path_i);
            $human->path_credit  = unserialize($human->path_credit);
            $human->path_qualification  = unserialize($human->path_qualification);
            $human->path_degree  = unserialize($human->path_degree);
            $human->path_title  = unserialize($human->path_title);
            $human->path_skill  = unserialize($human->path_skill);
        }
        session(['credential'=>config('transforms.human')]); //用于selectFile的type参数
        return view('humans.index',compact('humans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path_i = serialize($this->repo->storeFile($request, "path_i"));
        $path_credit =  serialize($this->repo->storeFile($request, "path_credit"));
        $path_qualification =  serialize($this->repo->storeFile($request, "path_qualification"));
        $path_degree =  serialize($this->repo->storeFile($request, "path_degree"));
        $path_title =  serialize($this->repo->storeFile($request, "path_title"));
        $path_skill =  serialize($this->repo->storeFile($request, "path_skill"));

        $re = Human::create([
            'name'=>$request->name,
            'sex'=>$request->sex,
            'credit'=>$request->credit,
            'profession'=>$request->profession,
            'qualification'=>$request->qualification,
            'degree'=>$request->degree,
            'title'=>$request->title,
            'skill'=>$request->skill,
            'time_enter'=>$request->time_enter,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'remark'=>$request->remark,
            'path_i'=>$path_i,
            'path_credit'=>$path_credit,
            'path_qualification'=>$path_qualification,
            'path_degree'=>$path_degree,
            'path_title'=>$path_title,
            'path_skill'=>$path_skill,
            'graduated_at'=>$request->graduated_at,
            'gather_skill_at'=>$request->gather_skill_at,
            'gather_title_at'=>$request->gather_title_at,
            'department'=>$request->department,
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
        $human = Human::find($id);
        //目前是每个分类一个文件,所以更新时需要删除旧文件.
        //todo 改成数组后,前端展示界面,后端逻辑都要做一些改动.
        $human->path_i = $this->repo->updateFile($request, "path_i", $human->path_i);
        $human->path_credit = $this->repo->updateFile($request, "path_credit", $human->path_credit);
        $human->path_qualification = $this->repo->updateFile($request, "path_qualification", $human->path_qualification);
        $human->path_degree = $this->repo->updateFile($request, "path_degree", $human->path_degree);
        $human->path_title = $this->repo->updateFile($request, "path_title", $human->path_title);
        $human->path_skill = $this->repo->updateFile($request, "path_skill", $human->path_skill);

        $re = $human->update([
            'name'=>$request->name,
            'sex'=>$request->sex,
            'credit'=>$request->credit,
            'profession'=>$request->profession,
            'qualification'=>$request->qualification,
            'degree'=>$request->degree,
            'title'=>$request->title,
            'skill'=>$request->skill,
            'time_enter'=>$request->time_enter,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'remark'=>$request->remark,
            'path_i'=>$human->path_i,
            'path_credit'=>$human->path_credit,
            'path_qualification'=>$human->path_qualification,
            'path_degree'=>$human->path_degree,
            'path_title'=>$human->path_title,
            'path_skill'=>$human->path_skill,
            'graduated_at'=>$request->graduated_at,
            'gather_skill_at'=>$request->gather_skill_at,
            'gather_title_at'=>$request->gather_title_at,
            'department'=>$request->department,
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
        $human = Human::find($id);
        $this->repo->deleteFileIfNotNull($human->path_i);
        $this->repo->deleteFileIfNotNull($human->path_credit);
        $this->repo->deleteFileIfNotNull($human->path_qualification);
        $this->repo->deleteFileIfNotNull($human->path_degree);
        $this->repo->deleteFileIfNotNull($human->path_title);
        $this->repo->deleteFileIfNotNull($human->path_skill);

        $re = $human->delete();

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
        $human = Human::find($request->id);
        $k = $request->key;
        switch ($request->type){
            case 0:
                $path = unserialize($human->path_i);
                unset($path[$k]);
                $human->path_i = serialize($path);
                $human->save();
                break;
            case '1':
                $path = unserialize($human->path_credit);
                unset($path[$k]);
                $human->path_credit = serialize($path);
                $human->save();
                break;
            case '2':
                $path = unserialize($human->path_qualification);
                unset($path[$k]);
                $human->path_qualification = serialize($path);
                $human->save();
                break;
            case '3':
                $path = unserialize($human->path_degree);
                unset($path[$k]);
                $human->path_degree = serialize($path);
                $human->save();
                break;
            case '4':
                $path= unserialize($human->path_title);
                unset($path[$k]);
                $human->path_title = serialize($path);
                $human->save();
                break;
            case '5':
                $path = unserialize($human->path_skill);
                unset($path[$k]);
                $human->path_skill = serialize($path);
                $human->save();
                break;
            default:
                break;
        }
        return $data = [
            'data'=>'删除成功'
        ];
    }


}
