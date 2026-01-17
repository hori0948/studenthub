<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>成績編集画面</title>
</head>

<body>

    <h1>成績編集フォーム</h1>
    <form method="POST" action="{{ route('grades.update', $student->id) }}">
        @csrf
        @method('PUT')

        {{-- どの成績を更新するか判別するため、hiddenでidを送る --}}
        <input type="hidden" name="id" value="{{ $grade->id }}">

        {{-- 学年選択 --}}
        <p>
            <label>学年</label><br>
            <select name="grade" required>
                <option value="">選択してください</option>
                @for($i = 1; $i <= 3; $i++)
                    {{-- DB値（$grade->grade）を初期値として出力 --}}
                    <option value="{{ $i }}" {{ old('grade', $grade->grade) == $i ? 'selected' : '' }}>{{ $i }}年</option>
                    @endfor
            </select>
        </p>

        {{-- 学期選択 --}}
        {{-- 学期 --}}
        <p>
            <label>学期</label><br>
            <select name="term" required>
                <option value="">選択してください</option>
                @for($i = 1; $i <= 3; $i++)
                    {{-- DB値（$grade->term）を初期値として出力 --}}
                    <option value="{{ $i }}" {{ old('term', $grade->term) == $i ? 'selected' : '' }}>{{ $i }}学期</option>
                    @endfor
            </select>
        </p>

        <hr>

        {{-- 各教科の点数（セレクトボックス形式） --}}
        @php
        $subjectsMap = [
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

        @foreach($subjectsMap as $column => $label)
        <p>
            <label>{{ $label }}</label><br>
            <select name="{{ $column }}" required>
                <option value="">選択してください</option>
                @for($score = 1; $score <= 5; $score++)
                    {{-- 各教科のDB値を初期値として出力 --}}
                    <option value="{{ $score }}" {{ old($column, $grade->$column) == $score ? 'selected' : '' }}>{{ $score }}</option>
                    @endfor
            </select>
        </p>
        @endforeach

        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit">編集</button>
            <a href="{{ route('students.show', $student->id) }}">
                <button type="button">戻る</button>
            </a>
        </div>
    </form>

</body>

</html>