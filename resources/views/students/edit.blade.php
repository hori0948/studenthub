<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生編集画面</title>
</head>

<body>
    <h1>学生編集</h1>

    @if (isset($student))
    <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <table border="1" style="border-collapse: collapse; width: 50%; margin-bottom: 20px;">
            <tr>
                <th style="background-color: #f2f2f2; width: 200px; padding: 10px;">学生id</th>
                <td style="padding: 10px;">{{ $student->id }}</td>
            </tr>
            <tr>
                <th style="background-color: #f2f2f2; padding: 10px;">学年</th>
                <td style="padding: 10px;">
                    <select name="grade">
                        @for($i = 1; $i <= 3; $i++)
                            <option value="{{ $i }}" {{ old('grade', $student->grade) == $i ? 'selected' : '' }}>{{ $i }}年</option>
                            @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <th style="background-color: #f2f2f2; padding: 10px;">名前</th>
                <td style="padding: 10px;">
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" required style="width: 80%;">
                </td>
            </tr>
            <tr>
                <th style="background-color: #f2f2f2; padding: 10px;">住所</th>
                <td style="padding: 10px;">
                    <input type="text" name="address" value="{{ old('address', $student->address) }}" required style="width: 80%;">
                </td>
            </tr>
            <tr>
                <th style="background-color: #f2f2f2; padding: 10px;">顔写真</th>
                <td style="padding: 10px;">
                    @if($student->img_path)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $student->img_path) }}" width="100" alt="現在の写真">
                        <p style="font-size: 0.8em; color: #666;">※現在の写真</p>
                    </div>
                    @endif
                    <input type="file" name="img_path">
                </td>
            </tr>
            <tr>
                <th style="background-color: #f2f2f2; padding: 10px;">コメント</th>
                <td style="padding: 10px;">
                    <textarea name="comment" rows="4" style="width: 80%;">{{ old('comment', $student->comment) }}</textarea>
                </td>
            </tr>
        </table>

        <div style="display: flex; gap: 10px;">
            <button type="submit">編集</button>
            <a href="{{ route('students.show', $student->id) }}">
                <button type="button">戻る</button>
            </a>
        </div>
    </form>

    @else
    <p>学生情報が見つかりませんでした。</p>
    <a href="{{ route('students.index') }}">一覧に戻る</a>
    @endif

</body>

</html>