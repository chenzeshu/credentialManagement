<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26
 * Time: 15:36
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Storage;

class HumanRepository
{
    /**
     * 判断路径是否为空值
     * @param $path
     */
    public function deleteFileIfNotNull($path)
    {
        $path = unserialize($path);
        if(!empty($path)){
            foreach ($path as $v){
                Storage::delete($v);
            }
        }
    }

    /**
     * @param $request
     * @param $path_name 文件的字段名
     * @return array|null
     */
    public function storeFile($request, $path_name)
    {
        if($request->hasFile($path_name)){
            $path = [];
            $files = $request->file($path_name);
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path[$name] = Storage::putFileAs('public/humans', $file, $name);
            }
            return $path;
        }else{
            return null;
        }
    }

    /**
     * @param $request
     * @param $path_name  文件的字段名
     * @param $_path  文件字段的原数据
     * @return null|string
     */
    public function updateFile($request, $path_name, $_path)
    {
        //fixme 当出现同名文件时,array_merge报错,所以应增加一个剔除重名的函数,但是这里目前可以缩略
        //$_path分单文件、数组的情况，否则报错array_merge(): Argument #2 is not an array
        //假如create时，没有文件，那么$_path就是"a:0:{}"，反序列化后，就是[]

        if($path = $this->storeFile($request, $path_name)){   //假如更新时更新了文件
            $_path = unserialize($_path);
            if(empty($_path)){
                return serialize($path);
            }
            return serialize(array_merge($path, $_path));
        }else{      //假如更新时没有更新文件
            return $_path;
        }
    }
}