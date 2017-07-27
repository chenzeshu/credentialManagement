<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histroy_detail extends Model
{
    protected $guarded = [];

    protected $hidden = [
      'file_belongs'
    ];

    public function histroy()
    {
        return $this->belongsTo('App\Histroy');
    }

//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    }
}
