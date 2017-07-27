<?php

namespace App\Http\Controllers;

use App\Events\CheckerChangement;
use App\Histroy;
use App\Manage_util;
use App\Repositories\ManageRepository;
use App\Repositories\ManageUtilsRepository;
use App\User;
use Illuminate\Http\Request;

class ManageUtilController extends Controller
{
    protected $repo;
    protected $manage_repo;

    function __construct(ManageUtilsRepository $repo, ManageRepository $manage_repo)
    {
        $this->repo = $repo;
        $this->manage_repo = $manage_repo;
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


    /**
     * 删除工具表单内的某项
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $re = Manage_util::findOrFail($id)->delete();
        if($re){
            return redirect()->back()->with('callback','删除成功');
        }
    }

    /**
     * 审批员确认修改并与原表合并，同时清空痕迹
     * 触发事件：App\Events\CheckerChangement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ensure()
    {
        //fixme 读了2次session,其实可以优化的
        $histroy_id = session('histroy_id');
        $adds = Manage_util::all()->toArray();
        //todo 触发消息机制(写在前面是因为合并时表被清空了)
        $this->manage_repo->insertChangeMsg($adds);
        //todo 合并
        $this->repo->dataTransaction($adds, $histroy_id);
        return redirect()->route('manage.show',$histroy_id)->with('callback', '审批员新增文件成功, 重复文件自动被剔除');
    }
}
