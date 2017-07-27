<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Histroy extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = ['username'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checker()
    {
        return $this->belongsTo('App\User','checker_id');
    }

    public function histroy_details()
    {
        return $this->hasMany('App\Histroy_detail');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

}
