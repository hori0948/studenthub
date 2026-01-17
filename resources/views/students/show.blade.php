<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生詳細表示画面</title>
</head>

<body>

    {{-- メッセージ表示 --}}
    @if (session('message'))
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        {{ session('message') }}
    </div>
    @endif

    <h1>学生表示</h1>

    {{-- 学生基本情報エリア --}}
    <table border="1" style="border-collapse: collapse; width: 50%; margin-bottom: 20px;">
        <tr>
            <th style="background-color: #f2f2f2; width: 200px; padding: 10px;">学年</th>
            <td style="padding: 10px;">{{ $student->grade }}年</td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">名前</th>
            <td style="padding: 10px;">{{ $student->name }}</td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">住所</th>
            <td style="padding: 10px;">{{ $student->address }}</td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">顔写真</th>
            <td style="padding: 10px;">
                @if($student->img_path)
                <img src="{{ asset('storage/' . $student->img_path) }}" alt="学生の顔写真" width="150">
                @else
                <span>（未登録）</span>
                @endif
            </td>
        </tr>

        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">コメント</th>
            <td style="padding: 10px;">{{ $student->comment ?? '（コメントはありません）' }}</td>
        </tr>
    </table>

    {{-- 学生編集ボタン --}}
    <div style="margin-bottom: 30px;">
        <a href="{{ route('students.edit', $student->id) }}">
            <button type="button">学生編集</button>
        </a>
    </div>

    <hr>

    {{-- 成績表示エリア --}}
    <h3>成績検索</h3>
    <form method="GET" action="{{ route('students.show', $student->id) }}" style="margin-bottom: 20px;">
        <select name="search_grade">
            <option value="">全ての学年</option>
            @for($i = 1; $i <= 3; $i++)
                <option value="{{ $i }}" {{ request('search_grade') == $i ? 'selected' : '' }}>{{ $i }}年</option>
                @endfor
        </select>

        <select name="search_term">
            <option value="">全ての学期</option>
            @for($i = 1; $i <= 3; $i++)
                <option value="{{ $i }}" {{ request('search_term') == $i ? 'selected' : '' }}>{{ $i }}学期</option>
                @endfor
        </select>
        <button type="submit">検索</button>
        <a href="{{ route('students.show', $student->id) }}"><button type="button">クリア</button></a>
    </form>

    <h3>成績表示</h3>
    @if($student->grades->isEmpty())
    <p>成績が登録されていません。</p>
    @else
    <table border="1" style="border-collapse: collapse; width: 50%; text-align: center;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="padding: 10px;">年次</th>
                <th style="padding: 10px;">学期</th>
                @foreach($subjects as $displayName => $columnName)
                <th>{{ $displayName }}</th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr>
                <td style="padding: 8px;">{{ $grade->grade }}年</td>
                <td>{{ $grade->term }}学期</td>
                @foreach($subjects as $displayName => $columnName)
                <td>{{ $grade->$columnName ?? '-' }}</td>
                @endforeach
                <td>
                    {{-- flexのgapを10pxに広げ、中央揃え(center)に設定します --}}
                    <div style="display: flex; flex-direction: column; gap: 10px; align-items: center; padding: 5px;">

                        {{-- 成績編集ボタン --}}
                        <a href="{{ route('grades.edit', ['student' => $student->id, 'id' => $grade->id]) }}" style="text-decoration: none;">
                            <button type="button" style="cursor: pointer; padding: 5px 10px;">成績編集</button>
                        </a>

                        {{-- 削除ボタン --}}
                        <form action="{{ route('grades.destroy', $student->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $grade->id }}">
                            <button type="submit" style="background-color: #ff4d4d; color: white; border: none; padding: 5px 15px; cursor: pointer; border-radius: 3px;">
                                削除
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- 下部ボタン --}}
    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <a href="{{ route('grades.add', $student->id) }}">
            <button type="button">成績登録</button>
        </a>

        <a href="{{ route('students.index') }}">
            <button type="button">戻る</button>
        </a>
    </div>

</body>

</html>