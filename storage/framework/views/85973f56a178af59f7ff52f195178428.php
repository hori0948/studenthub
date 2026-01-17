<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理ユーザー新規登録画面</title>
</head>

<body>
    <h1>ユーザー登録フォーム</h1>

    <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        <table>
            <tr>
                <td><label>ユーザー名</label></td>
                <td><input type="text" name="user_name" value="<?php echo e(old('user_name')); ?>">
                    <?php $__errorArgs = ['user_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: red;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </td>
            </tr>

            <tr>
                <td><label>メールアドレス</label></td>
                <td><input type="email" name="email" value="<?php echo e(old('email')); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: red;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </td>
            </tr>

            <tr>
                <td><label>パスワード</label></td>
                <td><input type="password" name="password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color: red;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </td>
            </tr>

            <tr>
                <td><label>パスワード（確認用）</label></td>
                <td><input type="password" name="password_confirmation"></td>
            </tr>

        </table>

        <a href="<?php echo e(route('showlogin')); ?>">
            <button type="submit">登録</button>
        </a><br>
        <a href="<?php echo e(route('showlogin')); ?>">
            <button type="button">戻る</button>
        </a>

    </form>


</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/auth/admin_user_register.blade.php ENDPATH**/ ?>