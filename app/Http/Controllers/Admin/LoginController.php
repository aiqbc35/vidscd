<?php

namespace App\Http\Controllers\admin;

use App\Admin;

use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    public function index ()
    {
        return view('Admin.login');
    }

    public function getHalt (Request $request)
    {
        if ($request->ajax()) {

            $data = $request->input();

            if ($data['username'] == '') {
                return array(
                    'status' => 2,
                    'msg' => 'username is empty'
                    );
            }
            if ($data['passwd'] == '') {
                return array(
                    'status' => 2,
                    'msg' => 'passwd is empty'
                );
            }

            $data['passwd'] = md5($data['passwd']);
            unset($data['_token']);
            $ret = Admin::where('username','=',$data['username'])->where('passwd','=',$data['passwd'])->first();

            if ($ret) {
                $info['status'] = 1;
                $info['msg'] = 'OK';
                Session::put('id',$ret->id);
                Session::put('username',$ret->username);
            }else{
                $info['status'] = 3;
                $info['msg'] = 'username or password error';
            }

            return $info;
        }
    }
}