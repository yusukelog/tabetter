<?php
session_start();
require ('dbconnect.php');

if(isset($_COOKIE['email']) && $_COOKIE['email'] !== ''){
    $email = $_COOKIE['email'];
}

if(!empty($_POST)){
    $email = $_POST['email'];
    if($_POST['email'] !== '' && $_POST['password'] !== ''){
        $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
        $login->execute(array(
            $_POST['email'],
            sha1($_POST['password'])
        ));
        $user = $login->fetch();
        if($user){
            $_SESSION['id'] = $user['id'];
            $_SESSION['time'] = time();

            // クッキーへログイン情報保存
            if($_POST['remember-me'] === 'on'){
                setcookie('email',$_POST['email'],time()+60*60*24*14);
            }

            header('Location:create.php');
            exit();
        }else{
            $error['login'] = 'failed';
        }
    }else{
        $error['login'] = 'blank';
    }
}

?>
<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<form action="" method="post" class="mx-auto p-4 mt-5" id="loginform">
    <h1 class="h5 text-dark text-center mb-5">ログイン</h1>
    <div class="form-group">
        <label for="inputEmail">メールアドレス</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="<?php if(!empty($email)) echo htmlspecialchars($email,ENT_QUOTES); ?>">
        <?php if(!empty($error['login']) && $error['login'] === 'blank'): ?>
            <div class="text-danger mt-1">メールアドレスとパスワードを入力してください</div>
        <?php endif; ?>
        <?php if(!empty($error['login']) && $error['login'] === 'failed'): ?>
            <div class="text-danger mt-1">メールアドレスとパスワードが一致しません</div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="inputPassword">パスワード</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" value="<?php if(!empty($_POST['password'])) echo htmlspecialchars($_POST['password'],ENT_QUOTES); ?>">
    </div>

    <div class="form-group">
        <label class="cursor-pointer">
            <input type="checkbox" name="remember-me" value="on"><span class="ml-2">次回ログイン省略する</span>
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block text-light" type="submit">ログイン</button>
</form>
<?php require('footer.php'); ?>
