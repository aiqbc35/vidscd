<?php

namespace App\Http\Controllers\Admin;


use App\Service;
use App\VideoService;
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

    public function clearCache()
    {
        Cache::forget('homeList');
        Cache::forget('videoServerLinkList');
        Cache::forget('imagesServer');
        Cache::forget('videoKey');
        Cache::forget('mobileHomeList');

        return redirect('/admin/htadmin');
    }

    /**
     * 视频服务器列表-视图
     */
    public function servicelink()
    {
        $data = VideoService::all();
        return view('Admin.servicelink',[
            'name'  =>  'Video Service Link',
            'data' => $data
        ]);
    }

    /**
     * 新增视频服务器视图
     */
    public function servicelinkView(Request $request)
    {
        $id = $request->get('id');
        $ret = '';
        if ($id != '') {
            $ret = VideoService::find($id);
        }
        return view('Admin.servicelinkadd',[
            'data' => $ret
        ]);
    }
    public function serviceLinkDelete(Request $request)
    {
        $id = $request->get('id');
        if ($id > 0) {
            $ret = VideoService::destroy($id);
            return redirect()->back();
        }
    }
    /**
     * 处理新增视频服务器数据
     * @param Request $request
     * @return array
     */
    public function serviceAdd(Request $request)
    {

        if ( $request->isMethod('post') ){
            $data = $request->input();

            $ifEmpty = self::checkServiceError($data);

            if ($ifEmpty['code'] != 1) {
                return redirect()->back()->with('error',$ifEmpty['msg'])->withInput();
            }
            if (empty($data['id'])){
                $result = VideoService::create($data);
            }else{
                $result = VideoService::where('id','=',$data['id'])->update(
                    ['title' => $data['title'],'link' => $data['link'],'type' => $data['type']]
                );
            }


            if ($result) {
                return redirect('/admin/servicelink');
            }else{
                return redirect()->back()->with('error','提交失败！')->withInput();
            }


        }
    }

    /**
     * 视频服务器添加判断是否为空
     * @param $data
     * @return array
     */
    static protected function checkServiceError($data)
    {
        if ($data['type'] == '') {
            return [
                'code' => 404,
                'msg'   =>  '类型不能为空'
            ];
        }

        if ($data['link'] == '') {
            return [
                'code' => 404,
                'msg' => '链接不能为空'
            ];
        }
        if ($data['title'] == '') {
            return [
                'code' => 404,
                'msg' => '标题不能为空'
            ];
        }
        return [
            'code' => 1,
            'msg' => ''
        ];
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
