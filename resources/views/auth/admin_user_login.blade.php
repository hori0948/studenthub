<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理ユーザーログイン画面</title>
</head>

<body>
    {{-- メッセージ表示 --}}
    @if (session('message'))
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        {{ session('message') }}
    </div>
    @endif

    <h1>ログインフォーム</h1>

    <form method="POST" action="{{ route('showlogin') }}">
        @csrf

        <table>
            <tr>
                <td><label>メールアドレス</label></td>
                <td><input type="email" name="email" value="{{ old('email') }}">
                    @error('email') <div style="color: red;">{{ $message }}</div> @enderror
                </td>
            </tr>

            <tr>
                <td><label>パスワード</label></td>
                <td><input type="password" name="password">
                    @error('password') <div style="color: red;">{{ $message }}</div> @enderror
                </td>
            </tr>

        </table>

        <div class="button-group">
            <button type="submit">ログイン</button>
        </div>
        <a href="{{ route('register') }}">
            <button type="button">新規登録</button>
        </a>

    </form>

</body>

</html>