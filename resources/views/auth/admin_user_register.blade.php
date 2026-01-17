<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理ユーザー新規登録画面</title>
</head>

<body>
    <h1>ユーザー登録フォーム</h1>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <table>
            <tr>
                <td><label>ユーザー名</label></td>
                <td><input type="text" name="user_name" value="{{ old('user_name') }}">
                    @error('user_name') <div style="color: red;">{{ $message }}</div> @enderror
                </td>
            </tr>

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

            <tr>
                <td><label>パスワード（確認用）</label></td>
                <td><input type="password" name="password_confirmation"></td>
            </tr>

        </table>

        <a href="{{ route('showlogin') }}">
            <button type="submit">登録</button>
        </a><br>
        <a href="{{ route('showlogin') }}">
            <button type="button">戻る</button>
        </a>

    </form>


</body>

</html>