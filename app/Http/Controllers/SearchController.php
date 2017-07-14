<?php

namespace App\Http\Controllers;

use App\credential_1;
use App\credential_2;
use App\credential_3;
use App\credential_4;
use App\credential_5;
use App\credential_6;
use App\credential_basic;
use App\Human;
use App\Patent;
use App\SoftCertificate;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function __construct()
    {
    }

    public function search(Request $request)
    {
        $type = $request->search_type;
        $name = $request->name;
        return $this->decideWhichToReturn($type, $name);
    }

    private function decideWhichToReturn($type, $name){
        switch ($type){
            case 0:
                $humans = $this->type_0($name);
                return view('humans.index',compact('humans'));
                break;
            case 1:
                $credentials = $this->type_1($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 2:
                $credentials = $this->type_2($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 3:
                $credentials = $this->type_3($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 4:
                $credentials = $this->type_4($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 5:
                $credentials = $this->type_5($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 6:
                $credentials = $this->type_6($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 7:
                $credentials = $this->type_7($name);
                return view('credentials.index',compact('credentials'));
                break;
            case 8:
                $softs = SoftCertificate::where('name','like',"%{$name}%")->paginate(15);
                //todo 反序列化
                foreach ($softs as $soft){
                    $soft->path_auth = unserialize($soft->path_auth);
                    $soft->path_soft = unserialize($soft->path_soft);
                }
                return view('softs.index', compact('softs'));
                break;
            case 9:
                $patents = Patent::where('name','like',"%{$name}%")->paginate(15);
                foreach ($patents as $patent){
                    $patent->path = unserialize($patent->path);
                }
                return view('patents.index', compact('patents'));
                break;
            default:
                break;
        }
    }

    /**
     * 人事表
     * @param $name
     * @return mixed
     */
    public function type_0($name)
    {
        $humans = Human::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($humans as $human){
            $human->path_i  = unserialize($human->path_i);
            $human->path_credit  = unserialize($human->path_credit);
            $human->path_qualification  = unserialize($human->path_qualification);
            $human->path_degree  = unserialize($human->path_degree);
            $human->path_title  = unserialize($human->path_title);
            $human->path_skill  = unserialize($human->path_skill);
        }
        return $humans;
    }

    /**
     * 基本资质表
     * @param $name
     * @return mixed
     */
    public function type_1($name)
    {
        $credentials = credential_basic::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_basic',
            'name' => '基本资质']);
        return $credentials;
    }

    /**
     * 服务基地、研发中心表
     * @param $name
     * @return mixed
     */
    public function type_2($name)
    {
        $credentials = credential_1::where('name', 'like', '%'.$name.'%')->paginate(15);
        session(['credential'=>'credentials_1',
            'name' => '服务基地、研发中心',
            'url_name'=>'']);

        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        return $credentials;
    }

    /**
     * 获奖、荣誉表、高新技术产品表
     * @param $name
     * @return mixed
     */
    public function type_3($name)
    {
        $credentials = credential_2::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_2',
            'name' => '获奖、荣誉表、高新技术产品']);
        return $credentials;
    }

    /**
     * 服务感谢信表
     * @param $name
     * @return mixed
     */
    public function type_4($name)
    {
        $credentials = credential_3::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_3',
            'name'=>'服务感谢信']);
        return $credentials;
    }

    /**
     * 商标表
     * @param $name
     * @return mixed
     */
    public function type_5($name)
    {
        $credentials = credential_4::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_4',
            'name' => '商标']);
        return $credentials;
    }

    /**
     * 体系、贯标数据表
     * @param $name
     * @return mixed
     */
    public function type_6($name)
    {
        $credentials = credential_5::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_5',
            'name' => '体系贯标数据']);

        return $credentials;
    }

    /**
     * 第三方产品监测、鉴定数据库
     * @param $name
     * @return mixed
     */
    public function type_7($name)
    {
        $credentials = credential_6::where('name', 'like', '%'.$name.'%')->paginate(15);
        foreach ($credentials as $credential){
            $credential->path = unserialize($credential->path);
        }
        session(['credential'=>'credentials_6',
            'name' => '第三方产品检测、鉴定']);
        return $credentials;
    }

}
