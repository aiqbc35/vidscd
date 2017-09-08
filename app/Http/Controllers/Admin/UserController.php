<?php

namespace App\Http\Controllers\Admin;


use App\AdminUser;
use App\Uservip;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    public function index ()
    {
        $list = AdminUser::where('type','=',0)->get();
        $name = 'PUBLIC USER';
        return view('Admin.user',[
            'list' => $list,
            'name' => $name
        ]);
    }

    public function vip ()
    {
        $list = AdminUser::where('type','=',1)->get();
        $name = 'VIP USER';
        return view('Admin.user',[
            'list' => $list,
            'name' => $name
        ]);
    }



    public function delete (Request $request)
    {
        if ($request->id) {
            $result = AdminUser::find($request->id);
            if (empty($result)) {
                return array(
                    'status' => 2,
                    'msg' => 'User is empty'
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

    public function setVip (Request $request)
    {

        if ($request->id) {
            $result = AdminUser::find($request->id);
            if (empty($result)) {
                return array(
                    'status' => 2,
                    'msg' => 'User is empty'
                );
            }
            $result->type = 1;
            $is = $result->save();

            if ($is) {

                $vip['user_id'] = $result->id;
                $vip['startime'] = time();
                $vip['stoptime'] = strtotime('+1year');
                $vip['addtime'] = time();
                Uservip::create($vip);

                $info['status'] = 1;
                $info['msg'] = 'OK';
            }else{
                $info['status'] = 3;
                $info['msg'] = 'error！';
            }
            return $info;
        }
    }
}