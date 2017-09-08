<?php

namespace App\Http\Controllers\Admin;


use App\Service;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class SystemController
{

    public function index ()
    {
        $cache = Cache::get('imagesServer');
        $info = Service::find(3);

        return view('Admin.system',[
            'name' => 'System',
            'info' => $info
        ]);
    }

    public function addHalt (Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (empty($data['images']) || $data['video'] == '') {
                return redirect()->back()->with('error','图片以及视频服务器地址不能为空！')->withInput();
            }
            $info = Service::find(3);
            if (empty($info)) {
                return redirect()->back()->with('error','数据库没有这项内容！')->withInput();
            }
            $info->images = $data['images'];
            $info->video = $data['video'];
            $info->vipvideo = $data['vipvideo'];

            $result = $info->save();

            if ($result) {
                Cache::put('imagesServer',$info->images,3600);
                Cache::put('videoServer',$info->video,3600);
                return redirect()->back()->with('success','修改成功！');
            }else{
                return redirect()->back()->with('error','修改失败！')->withInput();
            }
        }
    }

}
