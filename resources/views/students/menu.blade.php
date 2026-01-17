<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>メニュー</title>
</head>

<body>

    {{-- メッセージ表示 --}}
    @if (session('message'))
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        {{ session('message') }}
    </div>
    @endif

    <h1>メニュー</h1>

    <p>ログインユーザー：{{ Auth::user()->user_name }} </p>

    {{-- 学年更新ボタン：全生徒に影響するためformで送信します --}}
    <div>
        <form action="{{ route('upgrade') }}" method="POST" onsubmit="return confirm('年度切替を実行しますか？3年生のデータは削除されます。')">
            @csrf
            <button type="submit">学年更新</button>
        </form>
    </div>

    <div>
        <a href="{{ route('students.create') }}">
            <button type="button">学生登録</button>
        </a>
    </div>
    <div>
        <a href="{{ route('students.index') }}">
            <button type="button">学生表示</button>
        </a>
    </div>
</body>

</html>