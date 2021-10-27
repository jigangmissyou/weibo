<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show', 'create', 'store', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }
    //
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.show', compact('user','statuses'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        //注册后自动登录
//        Auth::login($user);
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '欢迎，您注册');
        return redirect()->route('users.show',[$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name. '关注的人';
        return view('users.show_follow', compact('users','title'));
    }

    public function followers(User $user)
    {
        $users =$user->followers()->paginate(30);
        $title = $user->name. '的粉丝';
        return view('users.show_follow', compact('users','title'));
    }

    /**
     * 修改用户资料
     * @param User $user
     * @param Request $request
     */
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data = [];
        $data['name'] = $request->name;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更新成功');
        return redirect()->route('users.show', $user);
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'email.confirm';
        $data = compact('user');
        $from = 'guojigang@qq.com';
        $name='测试';
        $to = $user->email;
        $subject = '感谢注册Weibo应用，祝您使用愉快';
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        } );
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Auth::login($user);
        session()->flash('success', '恭喜您激活成功');
        return redirect()->route('users.show',[$user]);
    }
}
