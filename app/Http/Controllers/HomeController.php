<?php

namespace App\Http\Controllers;


use App\AdminUser;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{

    public function index ()
    {
        return view('Home.index');
    }

    public function list()
    {
        return view('Home.list');
    }

    public function listVip()
    {
        return view('Home.listvip');
    }
    public function vip(){
        return view('Home.vip');
    }
    public function userinfo()
    {
        return view('Home.userinfo');
    }
    public function view (Request $request)
    {
        $id = $request->get('id');
        $video = null;
        if (!is_null($id)) {
            $result = app('App\Http\Controllers\ApiController')->getOneVideo($id);
            if (isset($result['status']) && $result['status'] == 1) {
                $video = $result;
            }
        }
        return view('Home.view',[
            'video' =>  $video
        ]);
    }

    public function member ()
    {

        return view('Home.member');
    }

    public function logout ()
    {
        Session::flush();
        //Cookie::forget('tokenIdAuth');
        Cookie::queue('COOKIE-TOKEN',null,-1);
        return redirect('/');
    }


}