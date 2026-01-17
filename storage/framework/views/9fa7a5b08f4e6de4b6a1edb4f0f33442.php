<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理ユーザーログイン画面</title>
</head>

<body>
    
    <?php if(session('message')): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <h1>ログインフォーム</h1>

    <form method="POST" action="<?php echo e(route('showlogin')); ?>">
        <?php echo csrf_field(); ?>

        <table>
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

        </table>

        <div class="button-group">
            <button type="submit">ログイン</button>
        </div>
        <a href="<?php echo e(route('register')); ?>">
            <button type="button">新規登録</button>
        </a>

    </form>

</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/auth/admin_user_login.blade.php ENDPATH**/ ?>