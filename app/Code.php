<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/8/26
 * Time: 01:35
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'code';

    public $timestamps = false;

    protected $fillable = ['code','addtime'];


    public function adminuser()
    {
        return $this->hasOne('App\AdminUser','id','upuser');
    }
}