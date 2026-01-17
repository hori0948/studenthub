<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生詳細表示画面</title>
</head>

<body>
    <h1>学生詳細</h1>


    <a href="<?php echo e(route('students.student_show')); ?>">戻る</a>
    
    <a href="<?php echo e(route('grades.student_grade_add')); ?>">成績追加</a>
    <a href="<?php echo e(route('students.student_edit')); ?>">学生編集</a>
    <a href="<?php echo e(route('grades.grade_edit')); ?>">成績編集</a>

    <button type="submit">成績検索</button>


</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/students/student_details.blade.php ENDPATH**/ ?>