<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeLog extends Model
{
    protected $table = 'code_log';

    public $timestamps = false;

    protected $fillable = ['user_id','code_id','code','type','username','addtime','stoptime'];


}
