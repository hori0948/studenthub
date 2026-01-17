<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生詳細表示画面</title>
</head>

<body>

    
    <?php if(session('message')): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <h1>学生表示</h1>

    
    <table border="1" style="border-collapse: collapse; width: 50%; margin-bottom: 20px;">
        <tr>
            <th style="background-color: #f2f2f2; width: 200px; padding: 10px;">学年</th>
            <td style="padding: 10px;"><?php echo e($student->grade); ?>年</td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">名前</th>
            <td style="padding: 10px;"><?php echo e($student->name); ?></td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">住所</th>
            <td style="padding: 10px;"><?php echo e($student->address); ?></td>
        </tr>
        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">顔写真</th>
            <td style="padding: 10px;">
                <?php if($student->img_path): ?>
                <img src="<?php echo e(asset('storage/' . $student->img_path)); ?>" alt="学生の顔写真" width="150">
                <?php else: ?>
                <span>（未登録）</span>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th style="background-color: #f2f2f2; padding: 10px;">コメント</th>
            <td style="padding: 10px;"><?php echo e($student->comment ?? '（コメントはありません）'); ?></td>
        </tr>
    </table>

    
    <div style="margin-bottom: 30px;">
        <a href="<?php echo e(route('students.edit', $student->id)); ?>">
            <button type="button">学生編集</button>
        </a>
    </div>

    <hr>

    
    <h3>成績検索</h3>
    <form method="GET" action="<?php echo e(route('students.show', $student->id)); ?>" style="margin-bottom: 20px;">
        <select name="search_grade">
            <option value="">全ての学年</option>
            <?php for($i = 1; $i <= 3; $i++): ?>
                <option value="<?php echo e($i); ?>" <?php echo e(request('search_grade') == $i ? 'selected' : ''); ?>><?php echo e($i); ?>年</option>
                <?php endfor; ?>
        </select>

        <select name="search_term">
            <option value="">全ての学期</option>
            <?php for($i = 1; $i <= 3; $i++): ?>
                <option value="<?php echo e($i); ?>" <?php echo e(request('search_term') == $i ? 'selected' : ''); ?>><?php echo e($i); ?>学期</option>
                <?php endfor; ?>
        </select>
        <button type="submit">検索</button>
        <a href="<?php echo e(route('students.show', $student->id)); ?>"><button type="button">クリア</button></a>
    </form>

    <h3>成績表示</h3>
    <?php if($student->grades->isEmpty()): ?>
    <p>成績が登録されていません。</p>
    <?php else: ?>
    <table border="1" style="border-collapse: collapse; width: 50%; text-align: center;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th style="padding: 10px;">年次</th>
                <th style="padding: 10px;">学期</th>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $displayName => $columnName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($displayName); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="padding: 8px;"><?php echo e($grade->grade); ?>年</td>
                <td><?php echo e($grade->term); ?>学期</td>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $displayName => $columnName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo e($grade->$columnName ?? '-'); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td>
                    
                    <div style="display: flex; flex-direction: column; gap: 10px; align-items: center; padding: 5px;">

                        
                        <a href="<?php echo e(route('grades.edit', ['student' => $student->id, 'id' => $grade->id])); ?>" style="text-decoration: none;">
                            <button type="button" style="cursor: pointer; padding: 5px 10px;">成績編集</button>
                        </a>

                        
                        <form action="<?php echo e(route('grades.destroy', $student->id)); ?>" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="margin: 0;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="hidden" name="id" value="<?php echo e($grade->id); ?>">
                            <button type="submit" style="background-color: #ff4d4d; color: white; border: none; padding: 5px 15px; cursor: pointer; border-radius: 3px;">
                                削除
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>

    
    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <a href="<?php echo e(route('grades.add', $student->id)); ?>">
            <button type="button">成績登録</button>
        </a>

        <a href="<?php echo e(route('students.index')); ?>">
            <button type="button">戻る</button>
        </a>
    </div>

</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/students/show.blade.php ENDPATH**/ ?>