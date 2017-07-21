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
        $histroy_id = session('histroy_id');
        if(!$histroy_id){
            return view('manage_util.index', compact('details'));
        }
        else{
            $histroy = Histroy::findOrFail($histroy_id);
            return view('manage_util.index', compact('details', 'histroy'));
        }

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

    /**
     * 审批员确认修改并与原表合并，同时清空痕迹
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ensure()
    {
        $histroy_id = session('histroy_id');
        $adds = Manage_util::all()->toArray();
        //todo 合并
        $this->repo->dataTransaction($adds, $histroy_id);

        return redirect()->route('manage.show',$histroy_id)->with('callback', '审批员新增文件成功, 重复文件自动被剔除');
    }
}
