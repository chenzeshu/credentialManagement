<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histroy_detail extends Model
{
    protected $guarded = [];

    public function histroy()
    {
        return $this->belongsTo('App\Histroy');
    }
}
