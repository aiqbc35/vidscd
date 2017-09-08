<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/8/4
 * Time: 18:50
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = ['username','password','addtime','ismobile'];
}