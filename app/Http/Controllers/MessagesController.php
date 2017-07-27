<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
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

    public function show($id)
    {
        $details = Histroy::findOrFail($id)->messages()->get();
        foreach ($details as $detail){
            if($detail->type == 0){
                $detail->names = unserialize($detail->names);
            }
        }
        return view('msgs._show', compact('details'));
    }
}
