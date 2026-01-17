<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学生登録画面</title>
</head>

<body>

    <!--登録完了メッセージの表示-->
    
    <?php if(session('message')): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6fffa;">
        <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <h1>学生登録フォーム</h1>

    
    <form method="POST" action="<?php echo e(route('students.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div>
            <label>学年</label>
            <select name="grade">
                <option value="">選択してください</option>
                <option value="1">1年生</option>
                <option value="2">2年生</option>
                <option value="3">3年生</option>
            </select>
        </div>

        <div>
            <label>名前</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>">
        </div>

        <div>
            <label>住所</label>
            <input type="text" name="address" value="<?php echo e(old('address')); ?>">
        </div>

        <div>
            <label>顔写真</label>
            
            <input type="file" name="img_path" required>
            <?php $__errorArgs = ['img_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div style="color: red;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <button>登録</button>
        </div>

    </form>

    <a href="<?php echo e(route('menu')); ?>">
        <button type="button">戻る</button></a>

</body>

</html><?php /**PATH C:\MAMP\htdocs\studenthub\resources\views/students/create.blade.php ENDPATH**/ ?>