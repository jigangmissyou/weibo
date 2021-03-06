<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }
    //
    public function create()
    {
        if (Auth::user())
        {
            return redirect()->route('users.show', [Auth::user()]);
        };
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                //登录成功后的操作
                session()->flash('success', '欢迎回来');
                return redirect()->route('users.show', [Auth::user()]);
            } else {
                Auth::logout();
                session()->flash('warning', '您的账号还没有激活，请检查邮件中的链接进行激活');
                return redirect('/');
            }
        } else {
            //登录失败后的操作
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已经成功退出');
        return redirect('login');
    }
}
