<?php

namespace App\Http\Controllers\Admin;


use App\AdminUser;
use App\Jobs\SendLinkMail;
use Symfony\Component\HttpFoundation\Request;

class MessageController
{
    public function index ()
    {
        return view('Admin.message');
    }

    public function addHalt(Request $request)
    {
        if ($request->isMethod('post')) {
            $title = $request->get('title');
            $content = $request->get('content');

            if ($title == '' || empty($content)) {
                return redirect()->back()->with('error','标题以及内容不能为空！')->withInput();
            }
            $user = AdminUser::all();
            if (!empty($user)) {
                foreach ($user as $value){
                    dispatch(new SendLinkMail($value->username,$title,$content));
                }
            }
            return redirect()->back()->with('success','发送成功！');
        }else{
           return false;
        }


    }

}