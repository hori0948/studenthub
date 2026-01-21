<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //成績登録画面
    public function add(Student $student)
    {
        // 表示したい教科名のリストを定義
        $subjects = ['国語', '数学', '理科', '社会', '音楽', '家庭科', '英語', '美術', '保健体育'];
        return view('grades.add', compact('student', 'subjects'));
    }

    public function store(Request $request, Student $student)
    {
        // 入力チェック（バリデーション）
        $request->validate([
            'grade' => 'required',
            'term' => 'required',
            'japanese' => 'required',
            'math'     => 'required',
            'science'  => 'required',
            'social_studies' => 'required',
            'music'          => 'required',
            'home_economics' => 'required',
            'english'        => 'required',
            'art'            => 'required',
            'health_and_physical_education' => 'required',
        ]);

        // 保存処理
        // student_id が紐付けられて保存
        // 1行のレコードとして全ての教科を保存
        $student->grades()->create([
            'grade' => $request->grade,
            'term'  => $request->term,
            'japanese'       => $request->japanese,
            'math'           => $request->math,
            'science'        => $request->science,
            'social_studies' => $request->social_studies,
            'music'          => $request->music,
            'home_economics' => $request->home_economics,
            'english'        => $request->english,
            'art'            => $request->art,
            'health_and_physical_education' => $request->health_and_physical_education,
        ]);

        return redirect()->route('students.show', $student->id)->with('message', '成績を追加しました');;
    }


    //成績編集画面の表示
    //GET /grades/{grade}/edit
    public function edit(Request $request, Student $student)
    {
        $grade = Grade::findOrFail($request->id);

        $subjects = [
            '国語' => 'japanese',
            '数学' => 'math',
            '理科' => 'science',
            '社会' => 'social_studies',
            '音楽' => 'music',
            '家庭科' => 'home_economics',
            '英語' => 'english',
            '美術' => 'art',
            '保健体育' => 'health_and_physical_education'
        ];

        return view('grades.edit', compact('student', 'grade', 'subjects'));
    }



    //成績の更新処理
    //PUT /grades/{grade}
    public function update(Request $request, Student $student)
    {
        // バリデーション
        $request->validate([
            'id'       => 'required|exists:school_grades,id',
            'grade'    => 'required|integer',
            'term'     => 'required|integer',
            'japanese' => 'required|integer',
            'math'     => 'required|integer',
            'science'  => 'required|integer',
            'social_studies' => 'required|integer',
            'music'          => 'required|integer',
            'home_economics' => 'required|integer',
            'english'        => 'required|integer',
            'art'            => 'required|integer',
            'health_and_physical_education' => 'required|integer',
        ]);

        // 編集対象の成績データを取得
        // Blade側の <form action="..."> で渡された $id を使用
        $grade = Grade::findOrFail($request->id);

        // 各教科のカラムと画面から送られた値を紐づけて更新
        $grade->update([
            'grade'          => $request->grade,
            'term'           => $request->term,
            'japanese'       => $request->japanese,
            'math'           => $request->math,
            'science'        => $request->science,
            'social_studies' => $request->social_studies,
            'music'          => $request->music,
            'home_economics' => $request->home_economics,
            'english'        => $request->english,
            'art'            => $request->art,
            'health_and_physical_education' => $request->health_and_physical_education,
        ]);

        // 学生詳細画面へ戻る
        return redirect()->route('students.show', $student->id)
            ->with('message', '成績を更新しました');
    }

    // 成績の削除処理
    public function destroy(Request $request, Student $student)
    {
        // バリデーション (hiddenのidが送られているか確認)
        $request->validate([
            'id' => 'required|exists:school_grades,id'
        ]);

        // フォームから送られた id を使ってデータを取得
        $grade = Grade::findOrFail($request->id);

        // データベースから削除
        $grade->delete();

        // メッセージを添えて詳細画面へ戻る
        return redirect()->route('students.show', $student->id)
            ->with('message', '成績を削除しました');
    }
}
