<?php

namespace App\Http\Controllers;

use App\Histroy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    protected $repo;

    /**
     * 权限:审批者,目前很无脑,就是2个人,都不用自行维护
     */
    function __construct()
    {
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
        $details = Histroy::findOrFail($id)->histroy_details()->paginate(15);
        foreach ($details as $k=>$detail){
              $detail->file_path = unserialize($detail->file_path);
        }
        return view('histroies._show', compact('details'));
    }

    /**
     * 审批者删除审批
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id){
            $histroy = Histroy::findorFail($id);
            //软删除histroy_details中对应的数据
            $histroy->histroy_details()->delete();
            //软删除histroy中对应的数据
            $histroy->delete();
        });

        return redirect()->back()->with('callback', '删除成功');
    }

}
