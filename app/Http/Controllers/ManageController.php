<?php

namespace App\Http\Controllers;

use App\Events\CheckerDelment;
use App\Histroy;
use App\Histroy_detail;
use App\Manage_util;
use App\Repositories\ManageRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ManageController extends Controller
{
    protected $repo;

    /**
     * 权限:审批者,目前很无脑,就是2个人,都不用自行维护
     */
    function __construct(ManageRepository $repo)
    {
        $this->repo = $repo;
        //todo 报错信息还没有做
        $this->middleware('role:checker');
    }

    /**
     * 展示:但是需要前置权限中间件
     * 然后通过Auth::id()来展示自己的审批对象
     */
    public function index()
    {
        $histroies = Histroy::where('checker_id',Auth::id())->with('user')->orderBy('updated_at', 'desc')->paginate(15);
        return view('manage.index', compact('histroies'));
    }

    /**
     * 审批通过  改变 histroy的type,并要求附上end_time
     */
    public function pass(Request $request)
    {
        Histroy::findOrFail($request->id)->update([
            'examine_type'=>1,
            'end_at'=>$request->end_time
        ]);
        return "审批完成";
    }

    /**
     * 审批拒绝, 改变 histroy的type,并要求附上reject_reason
     */
    public function reject(Request $request)
    {
        Histroy::findOrFail($request->id)->update([
            'examine_type'=>2,
            'rejection_reason'=>$request->reason
        ]);
        return "审批完成";
    }

    /**
     * 管理员查看细节
     */
    public function show($id)
    {
        //难点：无法间接修改二维数组内部的值的
        $histroy = Histroy::find($id);
        $info = $this->repo->getInfoForShow($histroy);
        $details = $this->repo->getDetailsForShow($histroy);
        session(['histroy_id' => $histroy->id]);
        return view('manage._show', compact('details','info'));
    }

    /**
     * 审批者删除审批
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id){
            $histroy = Histroy::findOrFail($id);
            //软删除histroy_details中对应的数据
            $histroy->histroy_details()->delete();
            //软删除histroy中对应的数据
            $histroy->delete();
        });

        return redirect()->back()->with('callback', '删除成功');
    }

    /**
     * AJAX
     * 管理员决定humans或softs的多个文件里的单个文件是否可以下载
     * @param Request $request
     * @return string
     */
    public function decide(Request $request)
    {
        $name = $request->name;  //数组的key,也是文件名
        $flag = $request->flag;  //比如是0还是1,代表选中还是未选中,指是否允许下载
        $type = $request->type;  //比如是path_i还是path_credit
        $id = $request->id;
        //todo 检索数据库
        $detail = Histroy_detail::findOrFail($id);
        $path = $detail->file_path;
        $path = unserialize($path);

        //todo 开始更新
        $path[$type][$name]['flag'] = $flag;
        $path = serialize($path);
        $re =  $detail->update([
            'file_path'=>$path
        ]);
        return $re === true ? "改变成功" : "改变失败";
    }

    /**
     * 删除用户提交的表单的内部文件
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy_detail($id)
    {
        $detail = Histroy_detail::findOrFail($id);
        $re = $detail->delete();
        if($re){
            //触发App/Events/CheckerDelment事件
            $this->repo->insertDelMsg($detail);
            return redirect()->back()->with('callback', '删除成功');
        }else{
            return redirect()->back()->withErrors('删除失败');
        }
    }

}
