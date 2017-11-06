<?php

namespace App\Http\Controllers\Admin;


use App\AdminUser;
use Illuminate\Support\Facades\Session;

class IndexController
{
    public function index()
    {
        $user = AdminUser::all();
        $data = self::memberType($user);
       return view('Admin.index',['data'=>$data]);
    }

    public function logout ()
    {
        Session::flush();
        return redirect('/webadminlogin');
    }

    static private function memberType($user)
    {
        static $viptype = 0;   //VIP总数
        static $dayuser = 0;    //当日新增会员
        static $dayvip = 0;     //当日新增VIP会员
        //用户总数
        $total = count($user);

        $date = date('Y-m-d',time());

        foreach ($user as $value) {
            if ($value->viptype == 1) {
                $viptype++;
            }
            $dataDate = date('Y-m-d',$value->addtime);

            if ($date == $dataDate) {
                $dayuser++;

                if ($value->viptype == 1) {
                    $dayvip++;
                }

            }

        }
        return [
            'total' =>  $total,
            'vip'   =>  $viptype,
            'dayuser'   =>  $dayuser,
            'dayvip'    =>  $dayvip
        ];
    }
}