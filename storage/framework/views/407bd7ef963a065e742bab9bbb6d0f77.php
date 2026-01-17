<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理ユーザーログイン</title>
</head>

<body>
    <h1>ログイン</h1>

    <?php if($errors->any()): ?>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li style="color:red"><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>">
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" name="password">
        </div>

        <button type="submit">ログイン</button>
    </form>

    <a href="<?php echo e(route('register')); ?>">新規登録</a>
</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/auth/login.blade.php ENDPATH**/ ?>