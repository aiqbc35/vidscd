<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/8/4
 * Time: 19:59
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    public $timestamps = false;

    protected $fillable = ['name','image','link','hit','sort','addtime'];

    public function sort()
    {
        return $this->hasOne('App\Sort','id','sort');
    }
}