<?php
namespace App\Http\Controllers\Admin;


use App\Sort;
use App\Video;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class VideoController
{
    public function index ()
    {

        $ret = Video::with('sort')->where('type','=',0)->where('status','=',1)->get();
        return view('Admin.video',[
            'name' => 'PUBLIC VIDEO',
            'list' => $ret,
            'image' => self::getImageServer(),
        ]);
    }

    static protected function getImageServer ()
    {
        return app('App\Http\Controllers\ApiController')::getImagesService();
    }

    public function add (Request $request)
    {

        $info = '';
        if ($request->id) {
            $info = Video::find($request->id);
        }
        $ret = Sort::all();
        return view('Admin.add',[
            'name' => 'ADD VIDEO',
            'sort' => $ret,
            'info' => $info
        ]);
    }

    public function addHalt (Request $request)
    {
        if ($request->isMethod('post')) {

            $file = $request->file('img');

            $bool = false;

            if (!empty($file)) {
                //判断文件是否上传成功
                if ($file->isValid()) {

                    //原文件名称
                    $originName = $file->getClientOriginalName();

                    //文件扩展名
                    $ext = $file->getClientOriginalExtension();

                    //文件类型
                    $type = $file->getClientMimeType();

                    //临时绝对路径
                    $realPath = $file->getRealPath();

                    //存储文件名
                    $filenName = date("Y-m-d").'-'.uniqid().'.'.$ext;

                    //执行上传文件
                    $bool = Storage::disk('ftp')->put($filenName,file_get_contents($realPath));

                }
            }

            //$model = new Video();

            $data['name'] = $request->input('title');
            $data['link'] = $request->input('link');
            if ($bool) {
                $data['image'] = $filenName;
            }
            $data['sort'] = $request->input('sort');
            $data['hit'] = mt_rand(1000,9999);
            $data['addtime'] = time();
            if ($request->input('id')) {
                $id = $request->input('id');
                $ret = Video::where('id','=',$id)->update($data);
            }else{
                $ret = Video::create($data);
            }


            if ($ret) {
                return redirect('admin/videoadd')->with('success','操作成功！');
            }else{
                return redirect()->back()->with('error','操作失败！')->withInput();
            }




        }
    }

    public function loading ()
    {
        $ret = Video::with('sort')->where('type','=',0)->where('status','=',0)->get();
        return view('Admin.video',[
            'name' => 'loading VIDEO',
            'list' => $ret,
            'image' => self::getImageServer()
        ]);
    }
    public function setvip (Request $request)
    {
        if ($request->id) {
            $ret = Video::find($request->id);
            if (empty($ret)) {
                return array(
                    'status' => 2,
                    'msg' => 'this is video empty',
                );
            }
            $ret->type = 1;
            $is = $ret->save();
            if ($is) {
                $info['status'] = 1;
                $info['msg'] = 'OK';
            }else{
                $info['status'] = 3;
                $info['msg'] = 'error';
            }
            return $info;
        }
    }
    public function setok (Request $request)
    {
        if ($request->id) {
            $ret = Video::find($request->id);
            if (empty($ret)) {
                return array(
                    'status' => 2,
                    'msg' => 'this is video empty',
                );
            }
            $ret->status = 1;
            $ret->addtime = time();
            $is = $ret->save();
            if ($is) {
                $info['status'] = 1;
                $info['msg'] = 'OK';
            }else{
                $info['status'] = 3;
                $info['msg'] = 'error';
            }
            return $info;
        }
    }
    public function delete (Request $request)
    {
        if ($request->id) {
            $result = Video::find($request->id);
            if (empty($result)) {
                return array(
                    'status' => 2,
                    'msg' => 'Video is empty'
                );
            }

            $ret = $result->delete();
            if ($ret) {
                $info['status'] = 1;
                $info['msg'] = 'OK';
            }else{
                $info['status'] = 3;
                $info['msg'] = 'error';
            }
            return $info;
        }
    }
    public function vip ()
    {

        $ret = Video::with('sort')->where('type','=',1)->where('status','=',1)->get();
        return view('Admin.video',[
            'name' => 'VIP VIDEO',
            'list' => $ret,
            'image' => self::getImageServer()
        ]);
    }
}