<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Permission;
use App\Role;
use App\User;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");  //先取消外键检查
        //清空权限相关的数据表
        Permission::truncate();
        Role::truncate();
        DB::table('role_user')->delete();  //因为有外键约束，所以不用truncate而用delete
        DB::table('permission_role')->delete();

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");  //再重设外键检查，如此便跳过了外键检查
        //创建初始的管理员用户
        $czs  = User::create([
            'name' => 'chenzeshu',
            'email' => '1193297950@qq.com',
            'password' => bcrypt('666666'),
        ]);
        $gxf  =User::create([
            'name' => '高晓峰',
            'email' => 'test@qq.com',
            'password' => bcrypt('666666'),
        ]);
        $qzy  = User::create([
            'name' => '钱正宇',
            'email' => 'test2@qq.com',
            'password' => bcrypt('666666'),
        ]);
        //创建初始的角色设定
        $admin = Role::create([
            'name'=>'admin',
            'display_name'=>'管理员',
            'description' => '超级管理员'
        ]);

        $checker = Role::create([
            'name'=>'checker',
            'display_name'=>'审批员',
            'description' => '审批员'
        ]);

        //创建相应的初始权限
        $permissions = [
            [
                'name'=>'create_role',
                'display_name'=>'创建角色',
            ],
            [
                'name'=>'edit_role',
                'display_name'=>'编辑角色',
            ],
            [
                'name'=>'delete_role',
                'display_name'=>'删除角色',
            ]
        ];
        foreach ($permissions as $permission){
            $manage_user = Permission::create($permission);
            //给相角色赋予相应的权限
            $admin->attachPermission($manage_user);
        }

        //给用户赋予相应的角色
        $czs->attachRole($admin);
        $gxf->attachRole($checker);
        $qzy->attachRole($checker);
    }
}
