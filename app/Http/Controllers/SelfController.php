<?php

namespace App\Http\Controllers;

use App\Histroy;
use App\Human;
use App\Repositories\SelfRepository;
use App\SelfTable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SelfController extends Controller
{
    protected $repo;
    
    function __construct(SelfRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function index()
    {
       $selfs = User::find(Auth::id())->selfTables()->paginate(15);
       //hidden后还是可以取到file_path，是否需要手工抹除……
       return view('self.index', compact('selfs'));
    }
    
    public function store(Request $request)
    {

    }

    public function destroy($id)
    {
        $re = SelfTable::findOrFail($id)->delete();
        if($re){
            return redirect()->back()->withErrors('删除成功');
        }else{
            return redirect()->back()->withErrors('删除失败');
        }
    }

    /**
     * 方法:GET
     * 用途:清除临时表中当前用户ID的所有关联数据
     * 删除方法:硬删除
     */
    public function destroyAll()
    {
        $id = Auth::id();
        $re = SelfTable::where('user_id',$id)->delete();
        if($re){
            return redirect()->back()->withErrors('清空成功');
        }
        else{
            return redirect()->back()->withErrors('清空失败,请刷新重试');
        }
    }    

    /**
     * 功能: 将用户选择的添加进个人临时表里
     * 注意1: 所有用户的个人临时表全部都放在一张表里,这张表是user表的子表,转移/清空临时表是清空用户同id数据
     * 注意2: 由于histroy_details拷贝的是本表, 所以从本表就要开始做humans和softs文件的筛选下载标记
     * 路由: self.input
     */
    public function inputFile(Request $request)
    {
        $ids = $request->fileId;
        $type = $request->type;
        //使用了事务+in优化sql
        return $this->repo->switchForSelfTable($type, $ids);
    }
}
