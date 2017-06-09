<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','last_login_at'
    ];
    //使将last_login_at当成日期处理
    protected $dates = [
      'last_login_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * selfTable是审批表的个人临时草稿表
     */
    public function selfTables()
    {
        return $this->hasMany('App\SelfTable');
    }

    /**
     * histroy是个人提交的审批表的总历史（审批表总览）
     */
    public function histroies()
    {
        return $this->hasMany('App\Histroy');
    }

    /**
     * User中的checker检索histroy表中需要自己审批的表
     */
    public function checkHistroies()
    {
        return $this->hasMany('App\Histroy');
    }

}
