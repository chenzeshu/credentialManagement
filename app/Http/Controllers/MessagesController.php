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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $msg = Histroy::findOrFail($id)->messages();
        //todo 更改该信息状态为已读
        $msg->update(['status'=>1]);
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
