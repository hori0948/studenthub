<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.admin_user_login')
            ->with('message', '管理ユーザーを登録しました');
    }

    public function login(Request $request)
    {
        // 必須入力チェック（「〜を入力してください」の表示）
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required'    => 'メールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
        ]);

        // メールアドレスが存在するかチェック
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // アドレス自体が見つからない場合
            return back()->withErrors(['email' => 'メールアドレスが間違っています。'])->withInput();
        }

        // パスワードが一致するかチェック
        // Auth::attempt を使い、失敗した場合はパスワードのみのエラーを返す
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'パスワードが間違っています。'])->withInput();
        }


        // ログイン成功
        $request->session()->regenerate();
        return redirect()->route('menu');
    }


    public function showRegister()
    {
        return view('auth.admin_user_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email'     => [
                'required',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9@.\-_]+$/', // 半角英数字と一部の記号のみ許可
            ],
            'password'  => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^[a-zA-Z0-9]+$/',
            ],
        ], [
            // ユーザー名
            'user_name.required' => 'ユーザー名を入力してください。',

            // メールアドレス
            'email.required' => 'メールアドレスを入力してください。',
            'email.email'    => '正いメールアドレス形式で入力してください。',
            'email.unique'   => 'このメールアドレスは既に登録されています。',
            'email.regex'     => 'メールアドレスは半角英数字で入力してください。',

            // パスワード
            'password.required'  => 'パスワードを入力してください。',
            'password.min'       => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードとパスワード（確認用）が一致しません。',
            'password.regex'     => 'パスワードは半角英数字で入力してください。',
        ]);

        // バリデーション通過後の登録処理
        \App\Models\User::create([
            'user_name'     => $request->user_name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('showlogin')->with('message', 'ユーザー登録が完了しました。');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
