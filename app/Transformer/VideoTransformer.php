<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/9/4
 * Time: 14:16
 */

namespace App\Transformer;


class VideoTransformer extends Transformer
{
    public function tranuform($item)
    {
        return array(
            'vid'    =>  $item['id'],
            'title'   => $item['name'],
            'scan'  =>  $item['hit'],
            'video' =>  $item['link'],
            'addtime'   =>  date('Y-m-d',$item['addtime']),
            'img'   =>  $item['image']
        );
    }
}