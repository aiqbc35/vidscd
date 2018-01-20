<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Request;

class MobileController
{
    public function index ()
    {
        return view('Mobile.index');
    }

    public function list ()
    {
        return view('Mobile.list');
    }

    public function listvip ()
    {
        return view('Mobile.listvip');
    }

    public function reg ()
    {
        return view('Mobile.reg');
    }

    public function login ()
    {
        return view('Mobile.login');
    }

    public function member()
    {
        return view('Mobile.member');
    }

    public function userinfo ()
    {
        return view('Mobile.userinfo');
    }

    public function upvip()
    {
        return view('Mobile.upvip');
    }

    public function view(Request $request)
    {
        $id = $request->get('id');
        $video = null;
        if (!is_null($id)) {
            $result = app('App\Http\Controllers\ApiController')->getOneVideo($id);
            if (isset($result['status']) && $result['status'] == 1) {
                $video = $result;
            }
        }
        $videoLinkList = app('App\Http\Controllers\ApiController')->getVideServiceLinkList();
        $LinkList = array_merge($videoLinkList['freelink'],$videoLinkList['viplink']);

        return view('Mobile.view',[
            'video' =>  $video,
            'link' => $LinkList
        ]);
    }

}