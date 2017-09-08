<?php

namespace App\Http\Controllers;


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

    public function view()
    {
        return view('Mobile.view');
    }

}