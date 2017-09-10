<?php

namespace App\Http\Middleware;

use App\AdminUser;
use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UserLogin
{
    public function handle($request,Closure $net)
    {
        $user_id = Session::get('user_id');
        $key = 'COOKIE-TOKEN';

        if (empty($user_id)) {
            if (!Cookie::has($key)) {
                return redirect('/mobile/login');
            }
            $info = Cookie::get($key);

            $user = AdminUser::where('id','=',$info['id'])->first();
            if (!isset($user->id) || $user->id == '') {
                return redirect('/mobile/login');
            }

            Session::put('user_id',$user->id);
        }

        return $net($request);
    }

}