<?php

namespace App\Http\Controllers;

use App\credential_1;
use App\Histroy;
use App\User;
use Debugbar;
use Illuminate\Http\Request;
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
        $test = config('titles.credential_1');
        dd($test);
    }
}
