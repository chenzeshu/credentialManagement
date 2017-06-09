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
     * 注意: 所有用户的个人临时表全部都放在一张表里,这张表是user表的子表,转移/清空临时表是清空用户同id数据
     * 路由: self.input
     */
    public function inputFile(Request $request)
    {
        $ids = $request->fileId;
        $type = $request->type;
        //使用了事务+in优化sql
        switch ($type){
            case 'human':
                return $this->repo->humanForeach($ids);
                break;
            case 'credentials_basic':
                $tableName = "credential_basics";  //todo 注意 middleware是`credentials_basic`,但是表和model都是credential_basic(s),这虽然有点尴尬,但是不影响.
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_1':
                $tableName = "credential_1s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_2':
                $tableName = "credential_2s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_3':
                $tableName = "credential_3s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_4':
                $tableName = "credential_4s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_5':
                $tableName = "credential_5s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'credentials_6':
                $tableName = "credential_6s";
                return $this->repo->credentialForeach($tableName, $ids);
                break;
            case 'patent':
                return $this->repo->patentForeach($ids);
                break;
            case 'soft':
                return $this->repo->softForeach($ids);
                break;
            default:
                break;
        }

    }


}
