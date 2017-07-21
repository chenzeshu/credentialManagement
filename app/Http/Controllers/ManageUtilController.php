<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Manage_util;
use App\Repositories\ManageUtilsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageUtilController extends Controller
{
    protected $repo;

    function __construct(ManageUtilsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $details = Manage_util::paginate(15);
        $histroy = Histroy::findOrFail(session('histroy_id'));
        return view('manage_util.index', compact('details', 'histroy'));
    }

    public function store(Request $request)
    {
        $ids = $request->fileId;
        $type = $request->type;
        //使用了事务+in优化sql
        return $this->repo->switchForManageUtil($type, $ids);
    }

    public function destroy($id)
    {
        $re = Manage_util::findOrFail($id)->delete();
        if($re){
            return redirect()->back()->with('callback','删除成功');
        }
    }

    public function ensure()
    {
        $histroy_id = session('histroy_id');
        $adds = Manage_util::all()->toArray();
        DB::transaction(function () use ($adds, $histroy_id){
            foreach ($adds as $add){
                Histroy::findOrFail($histroy_id)->histroy_details()->firstOrCreate($add);
            }
            //todo 清空manage_util表
            Manage_util::truncate();
        });

        return redirect()->route('manage.show',$histroy_id)->with('callback', '审批员新增文件成功, 重复文件自动被剔除');
    }
}
