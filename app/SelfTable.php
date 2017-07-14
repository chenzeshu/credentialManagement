<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelfTable extends Model
{
    /**
     * 功能:临时表, 作为user表的子表
     */
    protected $guarded = [];

    protected $hidden = [
      'file_path','file_belongs'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
