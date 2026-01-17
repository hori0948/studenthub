<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生登録画面</title>
</head>

<body>

    <!--登録完了メッセージの表示-->
    {{-- メッセージ表示 --}}
    @if (session('message'))
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        {{ session('message') }}
    </div>
    @endif

    <h1>学生登録フォーム</h1>

    {{-- enctype を追加することで画像ファイルが送信可能 --}}
    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label>学年</label>
            <select name="grade">
                <option value="">選択してください</option>
                <option value="1">1年生</option>
                <option value="2">2年生</option>
                <option value="3">3年生</option>
            </select>
        </div>

        <div>
            <label>名前</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>

        <div>
            <label>顔写真</label>
            {{-- ファイル選択 --}}
            <input type="file" name="img_path" required>
            @error('img_path')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button>登録</button>
        </div>

    </form>

    <a href="{{ route('menu') }}">
        <button type="button">戻る</button></a>

</body>

</html>