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
    <form method="POST" action="<?php echo e(route('grades.update', $student->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <input type="hidden" name="id" value="<?php echo e($grade->id); ?>">

        
        <p>
            <label>学年</label><br>
            <select name="grade" required>
                <option value="">選択してください</option>
                <?php for($i = 1; $i <= 3; $i++): ?>
                    
                    <option value="<?php echo e($i); ?>" <?php echo e(old('grade', $grade->grade) == $i ? 'selected' : ''); ?>><?php echo e($i); ?>年</option>
                    <?php endfor; ?>
            </select>
        </p>

        
        
        <p>
            <label>学期</label><br>
            <select name="term" required>
                <option value="">選択してください</option>
                <?php for($i = 1; $i <= 3; $i++): ?>
                    
                    <option value="<?php echo e($i); ?>" <?php echo e(old('term', $grade->term) == $i ? 'selected' : ''); ?>><?php echo e($i); ?>学期</option>
                    <?php endfor; ?>
            </select>
        </p>

        <hr>

        
        <?php
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
        ?>

        <?php $__currentLoopData = $subjectsMap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p>
            <label><?php echo e($label); ?></label><br>
            <select name="<?php echo e($column); ?>" required>
                <option value="">選択してください</option>
                <?php for($score = 1; $score <= 5; $score++): ?>
                    
                    <option value="<?php echo e($score); ?>" <?php echo e(old($column, $grade->$column) == $score ? 'selected' : ''); ?>><?php echo e($score); ?></option>
                    <?php endfor; ?>
            </select>
        </p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit">編集</button>
            <a href="<?php echo e(route('students.show', $student->id)); ?>">
                <button type="button">戻る</button>
            </a>
        </div>
    </form>

</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/grades/edit.blade.php ENDPATH**/ ?>