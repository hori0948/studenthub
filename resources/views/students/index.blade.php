<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生表示画面</title>
</head>

<body>
    <h1>学生表示</h1>

    <table border="1">
        <tr>
            <th>学年</th>
            <th>名前</th>
            <th></th>
        </tr>

        {{-- @forelse を使って「検索結果がない場合」を表示 --}}
        @forelse ($students as $student)
        <tr>
            <td>{{ $student->grade }}年生</td>
            <td>{{ $student->name }}</td>
            <td>
                <a href="{{  route('students.show', $student->id)}}" style="text-decoration: none;">
                    <button type="button" style="cursor: pointer; padding: 5px 10px;">詳細</button>
                </a>
            </td>
        </tr>
        @empty
        {{-- 検索結果が 0 件だった場合の表示 --}}
        <tr>
            <td colspan="3" style="text-align: center; color: red; padding: 10px;">
                該当する学生はいませんでした。
            </td>
        </tr>
        @endforelse

    </table>

    <br>

    <!--検索フォーム-->
    <form action="{{ route('students.index') }}" method="GET">
        <div>
            <label>学年</label>
            <select name="grade">
                <option value="">選択してください</option>
                {{-- request('grade') の値に合わせて選択状態を保持 --}}
                <option value="1" {{ request('grade') == '1' ? 'selected' : '' }}>1年生</option>
                <option value="2" {{ request('grade') == '2' ? 'selected' : '' }}>2年生</option>
                <option value="3" {{ request('grade') == '3' ? 'selected' : '' }}>3年生</option>
            </select>
        </div>
        <div>
            <input type="text" name="studentname" placeholder="学生名" value="{{ request('studentname') }}">
            <button type="submit">検索</button>

            {{-- ② 検索中（クエリパラメータがある時）だけ「全表示に戻る」ボタンを出す --}}
            @if(request('grade') || request('studentname'))
            <a href="{{ route('students.index') }}">
                <button type="button">全表示に戻る</button>
            </a>
            @endif

        </div>
    </form>

    <br>

    <a href="{{ route('menu') }}">
        <button type="button">戻る</button></a>

</body>

</html>