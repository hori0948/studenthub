<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>メニュー</title>
</head>

<body>

    
    <?php if(session('message')): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <h1>メニュー</h1>

    <p>ログインユーザー：<?php echo e(Auth::user()->user_name); ?> </p>

    
    <div>
        <form action="<?php echo e(route('upgrade')); ?>" method="POST" onsubmit="return confirm('年度切替を実行しますか？3年生のデータは削除されます。')">
            <?php echo csrf_field(); ?>
            <button type="submit">学年更新</button>
        </form>
    </div>

    <div>
        <a href="<?php echo e(route('students.create')); ?>">
            <button type="button">学生登録</button>
        </a>
    </div>
    <div>
        <a href="<?php echo e(route('students.index')); ?>">
            <button type="button">学生表示</button>
        </a>
    </div>
</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/students/menu.blade.php ENDPATH**/ ?>