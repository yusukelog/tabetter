<?php
session_start();
require ('dbconnect.php');

// フォームが送信されたか
if (!empty($_POST)) {
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    // アカウントの重複チェック
    if(empty($error)){
        $user = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email=?');
        $user->execute(array($_POST['email']));
        $record = $user->fetch();
        if($record['cnt'] > 0){
            $error['email'] = 'duplicate';
        }
    }

    if (empty($error)) {
        $_SESSION['regist'] = $_POST;
        var_dump($_SESSION['regist']);
//        header('Location:regist_confirm.php');
//        exit();
    }
}

if(isset($_SESSION['regist']) && $_REQUEST['action'] == 'rewrite'){
    $_POST = $_SESSION['regist'];
}
?>

<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">新規登録</h5>
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>ニックネーム</label>
                            <input type="text" class="form-control" name="name" value="<?php if(!empty($_POST['name'])) echo htmlspecialchars($_POST['name'],ENT_QUOTES); ?>">
                            <?php if(!empty($error['name']) && $error['name'] === 'blank'): ?>
                                <div class="text-danger mt-1">ニックネームを入力してください</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>メールアドレス</label>
                            <input type="text" class="form-control" name="email" value="<?php if(!empty($_POST['email'])) echo htmlspecialchars($_POST['email'],ENT_QUOTES); ?>">
                            <?php if(!empty($error['email']) && $error['email'] === 'blank'): ?>
                                <div class="text-danger mt-1">メールアドレスを入力してください</div>
                            <?php endif; ?>
                            <?php if(!empty($error['email']) && $error['email'] === 'duplicate'): ?>
                                <div class="text-danger mt-1">指定されたメールアドレスは既に登録されています</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>パスワード</label>
                            <input type="password" class="form-control" name="password"
                                   value="<?php if(!empty($_POST['password'])) echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
                            <?php if (!empty($error['password']) && $error['password'] === 'blank'): ?>
                                <div class="text-danger mt-1">パスワードを入力してください</div>
                            <?php endif; ?>
                            <?php if (!empty($error['password']) && $error['password'] === 'length'): ?>
                                <div class="text-danger mt-1">パスワードは4文字以上で入力してください</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary text-light px-4" type="submit">入力確認する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>
