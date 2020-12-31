<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function store(Request $request)
    {
        $rule = [
            'username' => 'required|min:5',
            'password' => 'required|min:8',
            'captcha' => 'required|captcha',
        ];
        // 表单验证
        $this->validate($request, $rule);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // 认证通过的
//            return response()->json(
//                [
//                    'status' => 'success',
//                    'msg' => '登录成功',
//                ]
//            );
            return $this->success('登录成功');
        } else {
            // 认证失败的
            return $this->fail('用户名或密码错误');
            /*return response()->json(
                [
                    'status' => 'fail',
                    'msg' => '用户名或密码错误',
                ]
            );*/
        }
    }
}
