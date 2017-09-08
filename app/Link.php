<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/8/5
 * Time: 00:33
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    public $timestamps = false;

    protected $fillable = ['title','link','sort'];
}