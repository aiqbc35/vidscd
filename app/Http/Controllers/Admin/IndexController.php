<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Session;

class IndexController
{
    public function index()
    {
        return view('Admin.index');
    }
    public function logout ()
    {
        Session::flush();
        return redirect('/webadminlogin');
    }
}