<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>学生成績登録画面</title>
</head>

<body>
    <h1>成績登録フォーム</h1>

    <form method="POST" action="{{ route('grades.store', $student->id) }}">
        @csrf
        <p>
            <label>学年</label><br>
            <select name="grade" required>
                <option value="">選択してください</option>
                @for($i = 1; $i <= 3; $i++)
                    <option value="{{ $i }}" {{ old('grade') == $i ? 'selected' : '' }}>{{ $i }}年</option>
                    @endfor
            </select>
        </p>

        <p>
            <label>学期</label><br>
            <select name="term" required>
                <option value="">選択してください</option>
                @for($i = 1; $i <= 3; $i++)
                    <option value="{{ $i }}" {{ old('term') == $i ? 'selected' : '' }}>{{ $i }}学期</option>
                    @endfor
            </select>
        </p>

        <hr>

        @php
        $subjects = [
        'japanese' => '国語',
        'math' => '数学',
        'science' => '理科',
        'social_studies' => '社会',
        'music' => '音楽',
        'home_economics' => '家庭科',
        'english' => '英語',
        'art' => '美術',
        'health_and_physical_education' => '保健体育'
        ];
        @endphp

        @foreach($subjects as $column => $label)
        <p>
            <label>{{ $label }}</label><br>
            <select name="{{ $column }}" required>
                <option value="">選択してください</option>
                @for($score = 1; $score <= 5; $score++)
                    <option value="{{ $score }}" {{ old($column) == $score ? 'selected' : '' }}>{{ $score }}</option>
                    @endfor
            </select>
        </p>
        @endforeach

        <div style="margin-top: 20px;">
            <button type="submit">成績登録</button>
            <a href="{{ route('students.show', $student->id) }}">
                <button type="button">戻る</button>
            </a>
        </div>

    </form>

</body>

</html>