<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/21
 * Time: 11:09
 */

namespace App\Repositories;


use App\Histroy;
use App\Manage_util;
use App\Repositories\CommonUtils\FileUtils;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageUtilsRepository extends FileUtils
{
//    本类只书写了manageUtils表的方法，公用方法已被提取到FileUtils类中

//    注意：session('histroy_id')是在点击“查看细节”按钮时存储的
    /**
     * manage_utils——审批员工具表的repo控制器
     * @param $type
     * @param $ids
     * @return string
     */
    public function switchForManageUtil($type, $ids)
    {
        switch ($type){
            case 'human':
                return $this->humanForeach($ids);
                break;
            case 'credentials_basic':
                $tableName = "credential_basics";  //todo 注意 middleware是`credentials_basic`,但是表和model都是credential_basic(s),这虽然有点尴尬,但是不影响.
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_1':
                $tableName = "credential_1s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_2':
                $tableName = "credential_2s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_3':
                $tableName = "credential_3s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_4':
                $tableName = "credential_4s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_5':
                $tableName = "credential_5s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'credentials_6':
                $tableName = "credential_6s";
                return $this->credentialForeach($tableName, $ids);
                break;
            case 'patent':
                return $this->patentForeach($ids);
                break;
            case 'soft':
                return $this->softForeach($ids);
                break;
            default:
                break;
        }
    }

    /**
     * 用途:为inputFile方法中的human情况提供代码量优化
     * @param $ids
     * @return string
     */
    private function humanForeach($ids)
    {
        //todo 使用in优化sql
        $humans = DB::table('humans')->whereIn('id', $ids)->get();
        //todo 制造文件开关标记
        $humans = $this->humanDownloadFlagTransformer($humans);
        //todo 使用事务优化sql(量没有到达万级,不拼接)
        DB::transaction(function () use ($humans){
            foreach ($humans as $human){
                Manage_util::firstOrCreate([
                    'histroy_id'=>session('histroy_id'),
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
    private function credentialForeach($tableName,$ids)
    {
        $credentials = DB::table($tableName)->whereIn('id', $ids)->get();
        DB::transaction(function () use ($credentials, $tableName){
            foreach ($credentials as $credential){
                Manage_util::firstOrCreate([
                    'histroy_id'=>session('histroy_id'),
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
    private function patentForeach($ids)
    {
        $patents = DB::table('patents')->whereIn('id', $ids)->get();
        DB::transaction(function () use ($patents){
            foreach ($patents as $patent){
                Manage_util::firstOrCreate([
                    'histroy_id'=>session('histroy_id'),
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
    private function softForeach($ids)
    {
        $softs = DB::table('soft_certificates')->whereIn('id', $ids)->get();

        $softs = $this->softsDownloadFlagTransformer($softs);

        DB::transaction(function () use ($softs){
            foreach ($softs as $soft){
                Manage_util::firstOrCreate([
                    'histroy_id'=>session('histroy_id'),
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
        return '插入softs成功';
    }

    public function dataTransaction($adds, $histroy_id)
    {
        DB::transaction(function () use ($adds, $histroy_id){
            foreach ($adds as $add){
                Histroy::findOrFail($histroy_id)->histroy_details()->firstOrCreate($add);
            }
            //todo 清空manage_util表
            Manage_util::truncate();
        });
    }
}