<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Uservip extends Model
{
    protected $table = 'user_vip';

    public $timestamps = false;

    protected $fillable = ['user_id','startime','stoptime','addtime'];
}