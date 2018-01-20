<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoService extends Model
{
    protected $table = 'video_service';

    public $timestamps = false;

    protected $fillable = ['title','link','type'];

}