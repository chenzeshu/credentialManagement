<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * 展示消息列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ids = [];
        $msgs = Message::where('user_id', Auth::id())->get();
        foreach ($msgs as $msg){
            if(!in_array($msg->histroy_id, $ids) ){
                $ids[] = $msg->histroy_id;
            }
        }
        $cols = collect([]);
        foreach ($ids as $id){
//            $_his = Histroy::where('id', $id)->with('messages')->first();
            $_his = Histroy::where('id', $id)->first();
            $_msg = Message::where('histroy_id', $_his->id)->count();
            $_his['_msg'] = $_msg;
            $cols->push($_his);
        }
        return view('msgs.index', compact('cols'));
    }

    /**
     * 展示更改详情
     * @param $histroy_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($histroy_id)
    {
        $msg = Histroy::findOrFail($histroy_id)->messages();
        //todo 更改该信息状态为已读
        $msg->update(['status'=>1]);
        //todo 更改session， 如果未读消息数目大于1， 则数量减一， 否则为空不显示
        session(['msg_count'=> session('msg_count') > 0 ? (session('msg_count') - 1) : null]);
        //todo 拿到信息详情
        $details = $msg->get();
        foreach ($details as $detail){
            if($detail->type == 0){
                $detail->names = unserialize($detail->names);
            }
        }
        return view('msgs._show', compact('details'));
    }

}
