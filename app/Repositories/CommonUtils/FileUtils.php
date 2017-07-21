<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/21
 * Time: 10:47
 */

namespace App\Repositories\CommonUtils;


class FileUtils
{
    /**
     * 反序列化Humans下载路径，并且初始化所有文件的下载标记为0
     * @param $humans
     * @return mixed
     */
    public function humanDownloadFlagTransformer($humans){
        foreach ($humans as $human){
            $human->path_i = unserialize($human->path_i);
            $human->path_credit = unserialize($human->path_credit);
            $human->path_qualification = unserialize($human->path_qualification);
            $human->path_degree = unserialize($human->path_degree);
            $human->path_title = unserialize($human->path_title);
            $human->path_skill = unserialize($human->path_skill);
            if($human->path_i){
                foreach ($human->path_i as $path_ik => $path_i){
                    $human->path_i[$path_ik] = [
                        'path'=>$path_i,
                        'flag'=>0
                    ];
                }
            }
            if($human->path_credit){
                foreach ($human->path_credit as $path_ck => $path_c){
                    $human->path_credit[$path_ck] = [
                        'path'=>$path_c,
                        'flag'=>0
                    ];
                }
            }
            if($human->path_qualification){
                foreach ($human->path_qualification as $path_qk => $path_q){
                    $human->path_qualification[$path_qk] = [
                        'path'=>$path_q,
                        'flag'=>0
                    ];
                }
            }
            //如果本来为空就不行了,所以要加一个为空的判断
            //todo 空数组呢->还未判断
            if($human->path_degree){
                foreach ($human->path_degree as $path_dk => $path_d){
                    $human->path_degree[$path_dk] = [
                        'path'=>$path_d,
                        'flag'=>0
                    ];
                }
            }
            if($human->path_title){
                foreach ($human->path_title as $path_tk => $path_t){
                    $human->path_title[$path_tk] = [
                        'path'=>$path_t,
                        'flag'=>0
                    ];
                }
            }
            if($human->path_skill){
                foreach ($human->path_skill as $path_sk => $path_s){
                    $human->path_skill[$path_sk] = [
                        'path'=>$path_s,
                        'flag'=>0
                    ];
                }
            }
        }
        return $humans;
    }

    /**
     * 反序列化Softs下载路径，并且初始化所有文件的下载标记为0
     * @param $humans
     * @return mixed
     */
    public function softsDownloadFlagTransformer($softs)
    {
        foreach ($softs as $soft){
            $soft->path_auth = unserialize($soft->path_auth);
            $soft->path_soft = unserialize($soft->path_soft);
            foreach ($soft->path_auth as $ak => $auth){
                $soft->path_auth[$ak] = [
                    'path'=>$auth,
                    'flag'=>0
                ];
            }
            foreach ($soft->path_soft as $sk => $s){
                $soft->path_soft[$sk] = [
                    'path'=>$s,
                    'flag'=>0
                ];
            }
        }

        return $softs;
    }
}