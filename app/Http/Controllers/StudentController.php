<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // 学生表示・検索
    // GET /students
    public function index(Request $request)
    {
        // クエリ（命令の土台）を作る
        $query = Student::query();

        // 学年が選択されていたら、条件を追加
        if ($request->grade) {
            $query->where('grade', $request->grade);
        }

        // 学生名が入力されていたら、条件を追加
        if ($request->studentname) {
            $query->where('name', 'LIKE', "%{$request->studentname}%");
        }

        // ソート機能の追加
        $sort = $request->get('sort', 'id');    // デフォルトはID
        $order = $request->get('order', 'asc'); // デフォルトは昇順
        $students = $query->orderBy($sort, $order)->get();

        // $.ajax からの通信だった場合の処理
        if ($request->ajax()) {
            $html = '<table border="1">
                    <tr>
                        <th><a href="#" id="sort-grade" data-order="' . ($order == 'asc' ? 'desc' : 'asc') . '">学年</a></th>
                        <th>名前</th>
                        <th></th>
                    </tr>';

            foreach ($students as $student) {
                $showUrl = route('students.show', $student->id);
                $html .= "<tr>
                        <td>{$student->grade}年生</td>
                        <td>{$student->name}</td>
                        <td>
                            <a href='{$showUrl}' style='text-decoration: none;'>
                                <button type='button' style='cursor: pointer; padding: 5px 10px;'>詳細</button>
                            </a>
                        </td>
                      </tr>";
            }

            if ($students->isEmpty()) {
                $html .= '<tr><td colspan="3" style="text-align: center; color: red; padding: 10px;">該当する学生はいませんでした。</td></tr>';
            }

            $html .= '</table>';
            return $html; // HTMLの断片だけを返す
        }

        // 学生表示画面
        return view('students.index', compact('students'));
    }


    // メニュー画面
    // GET /students/menu
    public function menu()
    {
        return view('students.menu');
    }

    // メニュー画面の学年更新
    // POST /students/apgrade
    public function upgrade()
    {
        // 3年生を削除（卒業処理）
        Student::where('grade', 3)->delete();

        // 1年生と2年生の学年を+1する
        Student::whereIn('grade', [1, 2])->increment('grade');

        return redirect()->route('menu')->with('message', '学年更新（年度切替）が完了しました。');
    }

    // 新規作成画面
    // GET /students/create
    public function create()
    {
        // 学生追加画面
        return view('students.create');
    }

    // 学生新規登録処理
    // POST /students
    public function store(Request $request)
    {
        $request->validate([
            'grade' => 'required',
            'name' => 'required',
            'address' => 'required',
            'img_path' => 'required|max:2048',
        ], [
            'img_path.required' => '顔写真を選択してください。',
        ]);

        // 画像ファイル保存
        $path = null;
        if ($request->hasFile('img_path')) {
            // fileinfoを使わない場合、ファイルの存在チェックのみで保存へ
            $path = $request->file('img_path')->store('students', 'public');
        }

        Student::create([
            'grade' => $request->grade,
            'name' => $request->name,
            'address' => $request->address,
            'img_path' => $path,
        ]);

        // 学生登録画面
        return redirect()->route('students.create')->with('message', '学生を登録しました');
    }

    // 詳細表示
    // GET /students/{student}
    public function show(Request $request, Student $student)
    {
        // gradesを読み込む
        $query = $student->grades();

        // 学年で検索
        if ($request->filled('search_grade')) {
            $query->where('grade', $request->search_grade);
        }

        // 学期で検索
        if ($request->filled('search_term')) {
            $query->where('term', $request->search_term);
        }

        // 学年(grade)の昇順、その次に学期(term)の昇順で並べ替える
        $grades = $query->orderBy('grade', 'asc')
            ->orderBy('term', 'asc')
            ->get();

        // 表示したい教科名のリストを定義
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

        // Ajax：テーブル部分のHTMLを返す
        if ($request->ajax()) {
            if ($grades->isEmpty()) {
                return '<p>成績が登録されていません。</p>';
            }

            // テーブルHTMLの組み立て
            $html = '<table border="1" style="border-collapse: collapse; width: 50%; text-align: center;">';
            $html .= '<thead style="background-color: #f2f2f2;"><tr><th>年次</th><th>学期</th>';
            foreach ($subjects as $name => $col) {
                $html .= "<th>{$name}</th>";
            }
            $html .= '<th></th></tr></thead><tbody>';

            foreach ($grades as $grade) {
                $html .= "<tr><td>{$grade->grade}年</td><td>{$grade->term}学期</td>";
                foreach ($subjects as $col) {
                    $score = $grade->$col ?? '-';
                    $html .= "<td>{$score}</td>";
                }

                // ボタンエリアの組み立て
                $editUrl = route('grades.edit', ['student' => $student->id, 'id' => $grade->id]);
                $deleteUrl = route('grades.destroy', $student->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                $html .= "<td>
                <div style='display: flex; flex-direction: column; gap: 10px; align-items: center; padding: 5px;'>
                    <a href='{$editUrl}' style='text-decoration: none;'>
                        <button type='button' style='cursor: pointer; padding: 5px 10px;'>成績編集</button>
                    </a>
                    <form action='{$deleteUrl}' method='POST' onsubmit=\"return confirm('本当に削除しますか？');\" style='margin: 0;'>
                        {$csrf} {$method}
                        <input type='hidden' name='id' value='{$grade->id}'>
                        <button type='submit' style='background-color: #ff4d4d; color: white; border: none; padding: 5px 15px; cursor: pointer; border-radius: 3px;'>削除</button>
                    </form>
                </div>
            </td></tr>";
            }
            $html .= '</tbody></table>';
            return $html;
        }
        // 学生詳細画面
        return view('students.show', compact('student', 'grades', 'subjects'));
    }

    // 編集画面
    // GET /students/{student}/edit
    public function edit(string $id)
    {
        // IDを元にデータベースから学生を1件取得
        $student = \App\Models\Student::findOrFail($id);
        // 学生編集画面
        return view('students.edit', compact('student'));
    }

    // 更新処理
    // PUT/PATCH /students/{student}
    public function update(Request $request, string $id)
    {
        // 対象の学生を取得
        $student = \App\Models\Student::findOrFail($id);

        // 入力チェック（バリデーション）
        $request->validate([
            'grade'   => 'required|integer',
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'comment' => 'nullable|string',
        ]);

        // データの準備
        $data = $request->only(['grade', 'name', 'address', 'comment']);

        // 画像がアップロードされた場合の処理
        if ($request->hasFile('img_path')) {
            // 古い画像の削除（ストレージを圧迫しないため）
            if ($student->img_path) {
                Storage::disk('public')->delete($student->img_path);
            }
            // 新しい画像を保存してパスを取得
            $data['img_path'] = $request->file('img_path')->store('students', 'public');
        }

        // データベース更新
        $student->update($data);

        // 詳細画面
        return redirect()->route('students.show', $student->id)
            ->with('message', '学生情報を更新しました');
    }
}
