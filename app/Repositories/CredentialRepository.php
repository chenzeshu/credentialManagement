<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 16:04
 */

namespace App\Repositories;


use Illuminate\Support\Facades\Storage;

class CredentialRepository
{
    /**
     * 用途：创建数据时的文件存储
     * @param $request
     * @param $dir
     * @return string
     */
    public function storeFile($request, $dir, $path = [])
    {
        if($request->hasFile('path')){
            $files = $request->file('path');
            foreach ($files as $file){
                $name = $file->getClientOriginalName();
                $path[$name] = Storage::putFileAs("public/{$dir}", $file, $name);
            }
        }
        return serialize($path);
    }

    /**
     * 新建一条数据，其中用到了call_user_func来适应7个credential
     * @param $request
     * @param $dir
     * @param $path
     * @return mixed
     */
    public function storeData($request, $dir, $path)
    {
        $classname = "\App\\".$dir;
        return call_user_func([$classname, 'create'],[
            'name'=>$request->name,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'path'=>$path,
            'remark'=>$request->remark
        ]);
    }

    /**
     * 更新数据，直接传入model实例
     * 其实可以使用call_user_func()来得到对应的实例，但是既然可以直接传，那就算了。
     * @param $request
     * @param $instance
     * @param $path
     * @return mixed
     */
    public function updateDate($request, $instance, $path)
    {
        return $instance->update([
            'name'=>$request->name,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_end,
            'path'=>$path,
            'remark'=>$request->remark
        ]);
    }

    public function removeFile($instance)
    {
        $paths = unserialize($instance->path);
        if(count($paths)>0){
            foreach ($paths as $path){
                Storage::delete($path);
            }
        }
    }

    /**
     * @param $instance credential的model实例
     * @param $key 是文件名，文件数组的设计为['name'=>'path']
     * @return array
     */
    public function AJAXremoveFile($instance, $key)
    {
        $_path = $instance->path;
        $_path = unserialize($_path);
        //todo 找到这个删的path所在的key,删去,并重新序列化保存(这个时候非常怀念nosql的hashmap)
        unset($_path[$key]);
        $instance->update([
            'path'=>serialize($_path)
        ]);
        return $data = [
            'data'=>'删除成功'
        ];
    }
}