<?php
/**
 * Created by PhpStorm.
 * User: rookie
 * Url : PTP6.Com
 * Date: 2017/9/4
 * Time: 00:49
 */

namespace App\Http\Controllers\Admin;


use App\Notice;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Request;

class NoticeController
{
    public function index ()
    {
        $list = Notice::all();
        return view('Admin.notice',[
            'name'  =>  'Notice',
            'list'  =>  $list
        ]);
    }

    public function add ()
    {
        return view('Admin.noticeAdd');
    }

    public function edit ($id)
    {
        $info = Notice::find($id);
        return view('Admin.noticeAdd',[
            'info'  =>  $info
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = Notice::where('id','=',$id)->delete();
        if ($ret) {
            $info['status'] = 1;
            $info['msg']    = '删除成功';
        }else{
            $info['status'] = 2;
            $info['msg']    = '删除失败';
        }
        return \Response($info);
    }

    public function addHalt(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if ($data['title'] == '' || empty($data['content'])) {

                return redirect()->back()->with('error','标题以及内容不能为空')->withInput();

            }
            if ($data['id'] > 0) {
                $result = Notice::where('id','=',$data['id'])
                    ->update([
                        'title' =>  $data['title'],
                        'content'   =>  $data['content']
                    ]);
            }else{
                $result = Notice::create([
                    'title' =>  $data['title'],
                    'content'   =>  $data['content'],
                    'addtime'   =>  date('Y-m-d')
                ]);
            }


            if ($result) {
                Cache::forget('homeList');
                return redirect('admin/notice');
            }else{
                return redirect()->back()->with('error','提交失败')->withInput();
            }
        }
    }

}