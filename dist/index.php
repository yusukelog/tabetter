<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<form action="" class="mx-auto p-4 mt-5" id="loginform">
    <h1 class="h5 text-dark text-center mb-5">ログイン</h1>
    <div class="form-group">
        <label for="inputEmail">メールアドレス</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required="" autofocus="">
    </div>

    <div class="form-group">
        <label for="inputPassword">パスワード</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="パスワード" required="">
    </div>

    <div class="form-group">
        <label class="cursor-pointer">
            <input type="checkbox" value="remember-me"><span class="ml-2">次回ログイン省略する</span>
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block text-light" type="submit">ログイン</button>
</form>
<?php require('footer.php'); ?>
