<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    public function handle($request,Closure $net)
    {
        $token = Session::get('id');
        if (empty($token)) {
            return redirect('webadminlogin');
        }

        return $net($request);
    }
}