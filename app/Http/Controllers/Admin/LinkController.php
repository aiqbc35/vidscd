<?php

namespace App\Http\Controllers\Admin;


use App\Link;
use Symfony\Component\HttpFoundation\Request;

class LinkController
{
    public function index ()
    {
        $list = Link::all();
        return view('Admin.link',[
            'name' => 'Links',
            'list' => $list
        ]);
    }

    public function add (Request $request)
    {
        $info = '';
        if ($request->id) {
            $info = Link::find($request->id);
        }
        return view('Admin.linkadd',[
            'name' => 'ADD LINK',
            'info' => $info
        ]);
    }

    public function delete (Request $request)
    {
        if ($request->id) {
            $result = Link::find($request->id);
            if (empty($result)) {
                return array(
                    'status' => 2,
                    'msg' => 'Link is empty'
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

    public function addHalt (Request $request)
    {
        if ($request->isMethod('post')) {
            $data['title'] = $request->input('title');
            $data['link'] = $request->input('link');
            $data['sort'] = $request->input('sort');

            if ($request->input('id')) {
                $id = $request->input('id');
                $ret = Link::where('id','=',$id)->update($data);
            }else{
                $ret = Link::create($data);
            }

            if ($ret) {
                return redirect('admin/links');
            }else{
                return redirect()->back()->with('error','操作失败！')->withInput();
            }
        }
    }
}