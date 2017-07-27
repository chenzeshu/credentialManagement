<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Jobs\UpdateHistroyJob;
use App\Message;
use App\Repositories\HistroyRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistroyController extends Controller
{
    //职责： 用户提交临时表去审批并形成提交历史

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
        //todo 拿到消息
        $counts = Message::where('user_id', Auth::id())->count();
        $histroies = User::findOrFail(Auth::id())->histroies()->with('checker')->orderBy('updated_at', 'desc')->paginate(15);

        session(['msg_count' => $counts]);

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
        if(!$request->reason_words){
            return redirect()->back()->withErrors('提交理由不能为空');
        }
        //todo 提交事件到队列
        $this->repo->dispatchUpdateToQueue($request);
        return redirect()->route('histroy.index')->with('callback', '提交成功,请稍后刷新页面,等待审批');

    }

    /**
     * @param $id histroy表的id, 用于检索histroy_details的数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $histroy = Histroy::findOrFail($id);
        $re = $this->repo->check($histroy); //todo 防止通过url绕过按钮 + 是否过期
        if($re){
            $details = $this->repo->transformDetail($histroy);
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
