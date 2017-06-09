<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Jobs\UpdateHistroyJob;
use App\Repositories\HistroyRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistroyController extends Controller
{
    protected $repo;

    public function __construct(HistroyRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 作用:用户查看跟自己有关的审批表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $histroies = User::findOrFail(Auth::id())->histroies()->with('checker')->orderBy('updated_at', 'desc')->paginate(15);
        return view('histroies.index', compact('histroies'));
    }

    /**
     * 功能:提交审批并清空临时表
     * Wating for 1.表单验证; 2.重构
     * 等基本尘埃落定再重构
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        //todo 可以做一个表单验证,防止提交空的reason_words

        //todo 逻辑开始
        if($request->reason_type==0){
            $checker= User::where('name','钱正宇')->first();
        }else{
            $checker= User::where('name','高晓峰')->first();
        }
        //todo 触发事件进入队列
        $job = (new UpdateHistroyJob($checker, Auth::id(), $request->reason_type, $request->reason_words))->onQueue('foo');
        $this->dispatch($job);

        return redirect()->route('histroy.index')->with('callback', '提交成功,请稍后刷新页面,等待审批');

    }

    /**
     * @param $id histroy表的id, 用于检索histroy_details的数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $histroy = Histroy::findOrFail($id);
        $this->repo->checkType($histroy); //todo 防止通过url绕过按钮
        $re = $this->repo->checkDate($histroy); //todo 验证是否过期

        if($re){
            $details = $histroy->histroy_details()->paginate(15);
            foreach ($details as $detail){
                $detail->file_path = unserialize($detail->file_path);
            }
            return view('histroies._show', compact('details'));
        }else{
            return redirect()->route('histroy.index')->withErrors('已过期');
        }

    }

    public function download($path)
    {
        return response()->download(storage_path('app/'.urldecode($path)));
    }

}
