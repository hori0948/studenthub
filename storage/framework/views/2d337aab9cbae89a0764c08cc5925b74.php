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

        
        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($student->grade); ?>年生</td>
            <td><?php echo e($student->name); ?></td>
            <td>
                <a href="<?php echo e(route('students.show', $student->id)); ?>" style="text-decoration: none;">
                    <button type="button" style="cursor: pointer; padding: 5px 10px;">詳細</button>
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        
        <tr>
            <td colspan="3" style="text-align: center; color: red; padding: 10px;">
                該当する学生はいませんでした。
            </td>
        </tr>
        <?php endif; ?>

    </table>

    <br>

    <!--検索フォーム-->
    <form action="<?php echo e(route('students.index')); ?>" method="GET">
        <div>
            <label>学年</label>
            <select name="grade">
                <option value="">選択してください</option>
                
                <option value="1" <?php echo e(request('grade') == '1' ? 'selected' : ''); ?>>1年生</option>
                <option value="2" <?php echo e(request('grade') == '2' ? 'selected' : ''); ?>>2年生</option>
                <option value="3" <?php echo e(request('grade') == '3' ? 'selected' : ''); ?>>3年生</option>
            </select>
        </div>
        <div>
            <input type="text" name="studentname" placeholder="学生名" value="<?php echo e(request('studentname')); ?>">
            <button type="submit">検索</button>

            
            <?php if(request('grade') || request('studentname')): ?>
            <a href="<?php echo e(route('students.index')); ?>">
                <button type="button">全表示に戻る</button>
            </a>
            <?php endif; ?>

        </div>
    </form>

    <br>

    <a href="<?php echo e(route('menu')); ?>">
        <button type="button">戻る</button></a>

</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/students/index.blade.php ENDPATH**/ ?>