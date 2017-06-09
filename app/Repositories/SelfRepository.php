<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 17:02
 */

namespace App\Repositories;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SelfRepository
{
    /**
     * 用途:为inputFile方法中的human情况提供代码量优化
     * @param $ids
     * @return string
     */
    public function humanForeach($ids)
    {
        //todo 使用in优化sql
        $humans = DB::table('humans')->whereIn('id', $ids)->get();
        //todo 使用事务优化sql(量没有到达万级,不拼接)
        DB::transaction(function () use ($humans){
            foreach ($humans as $human){
                User::find(Auth::id())->selfTables()->firstOrCreate([
                    'file_id'=>$human->id,
                    'file_name'=>$human->name,
                    'file_belongs' => 'humans',
                    'file_path' => serialize([
                        'path_i'=>$human->path_i,
                        'path_credit'=>$human->path_credit,
                        'path_qualification'=>$human->path_qualification,
                        'path_degree'=>$human->path_degree,
                        'path_title'=>$human->path_title,
                        'path_skill'=>$human->path_skill
                    ])
                ]);
            }
        });
        return 'human成功';
    }
    /**
     * 用途:为inputFile方法中的7种credential情况提供代码量优化
     * @param $tableName
     * @param $ids
     * @return string
     */
    public function credentialForeach($tableName,$ids)
    {
        $credentials = DB::table($tableName)->whereIn('id', $ids)->get();
        DB::transaction(function () use ($credentials, $tableName){
            foreach ($credentials as $credential){
                User::find(Auth::id())->selfTables()->firstOrCreate([
                    'file_id'=> $credential->id,
                    'file_name'=> $credential->name,
                    'file_belongs' => $tableName,  //填表名而不是model名
                    'file_path' => $credential->path
                ]);
            }
        });
        return '成功';
    }

    /**
     * 用途:为inputFile方法中的patent情况提供代码量优化
     * @param $ids
     * @return string
     */
    public function patentForeach($ids)
    {
        $patents = DB::table('patents')->whereIn('id', $ids)->get();
        DB::transaction(function () use ($patents){
            foreach ($patents as $patent){
                User::find(Auth::id())->selfTables()->firstOrCreate([
                    'file_id'=> $patent->id,
                    'file_name'=> $patent->name,
                    'file_belongs' => 'patents',  //填表名而不是model名
                    'file_path' => $patent->path
                ]);
            }
        });
        return '插入patents成功';
    }

    /**
     * 用途:为inputFile方法中的soft情况提供代码量优化
     * @param $ids
     * @return string
     */
    public function softForeach($ids)
    {
        $softs = DB::table('soft_certificates')->whereIn('id', $ids)->get();
        DB::transaction(function () use ($softs){
            foreach ($softs as $soft){
                User::find(Auth::id())->selfTables()->firstOrCreate([
                    'file_id'=> $soft->id,
                    'file_name'=> $soft->name,
                    'file_belongs' => 'soft_certificates',  //填表名而不是model名
                    'file_path' => serialize([
                        'path_auth'=>$soft->path_auth,
                        'path_soft'=>$soft->path_soft
                    ])
                ]);
            }
        });
        return '插入patents成功';
    }
}