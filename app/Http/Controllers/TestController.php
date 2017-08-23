<?php

namespace App\Http\Controllers;

use App\credential_1;
use App\Histroy;
use App\User;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function test1()
    {
        $c = credential_1::find(1);
        return $c->test;

        //todo 普通循环插入25s
        $params = array("name" => "50");
        set_time_limit(0);
        echo date("H:i:s");
        for ($i = 0; $i < 20000; $i++) {
            DB::table('test')->insert($params);
        };
        echo date("H:i:s");
        //todo 事务提交 10s
        echo date("H:i:s");

        $params = array("name" => "50");
        DB::transaction(function () use ($params) {
            for ($i = 0; $i < 20000; $i++) {
                DB::table('test')->insert($params);
            };
        });
        echo date("H:i:s");

        //todo 优化sql, sql语句拼接  0.1秒
        echo date("H:i:s");
        $sql = "insert into test (name) values";
        for ($i = 0; $i < 20000; $i++) {
            $sql .= "(50),";
        };
        $sql = substr($sql, 0, strlen($sql) - 1);
        DB::insert($sql);
        echo date("H:i:s");
    }

    public function test()
    {
        Cache::put('user'.Auth::id(), Auth::user(),7200);
    }

    public function memcached($key, Request $request)
    {
//        todo 10秒内，更改只会记录在缓存中，10秒后才持久化
        $value = [
            'name' => $request->name,
            'time' => time()
        ];
//      1. 假如缓存不存在$key, 则从数据库调取$key
        $data = Cache::get($key);

        $EXPIRE_IN = env('EXPIRE_IN');
//      2. 假如数据库不存在，进入缓存新建逻辑
        if(!$data){
            $re = Cache::add($key, $value, $EXPIRE_IN);
            $data = Cache::get($key);
        }
        $re_check = $this->checkTime($value, $data);

        //todo 更新缓存
        $this->saveToCache($key, $value, $EXPIRE_IN);
        if($re_check){
            //todo 并持久化
            $re_update = $this->saveToMysql($key, $value);

        }else{
            return response()->json([
                'errno' => 1000,
                'data'=> json_encode($value, JSON_UNESCAPED_SLASHES)
            ]);
        }
        return response()->json([
            'errno' => 1000,
            'data'=>"插入{$data['name']}成功"
        ]);
//      3. 在缓存新建$key， 并存储数据， 同时放入时间戳
//      4. 回到步骤1， 如果存在$key， 则更新数据， 并调取时间戳， 如果时间戳差值超过10秒， 则持久化， 未超过10秒， 则先缓存
        //fixme 如何做到10秒后没有请求， 自动持久化？
        //思路： 每次提交都会触发事件：事件判断10秒内是否有新请求， 有的话覆盖， 没的话就执行
//      5. 如果10秒后，没有数据更新， 则缓存数据会自动持久化到数据库


        //todo 根据hash_id进行提取

    }
    /**
     * 差值大于10秒返回true， 小于10秒返回false
     * @param $time
     * @return bool
     */
    private function checkTime($value, $data){
       $tenStamp = 10;
       return ($value['time'] - $data['time']) > $tenStamp  ? true : false;
    }


    private function saveToCache($key, $data, $EXPIRE_IN){
        Cache::put($key, $data, $EXPIRE_IN);
    }

    private function saveToMysql($key, $data){
        $self = DB::table('test')->where('hash_id', $key)->update([
            'name'=> $data['name']
        ]);
        return $self;
    }
}
