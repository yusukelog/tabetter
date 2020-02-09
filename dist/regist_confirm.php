<?php
session_start();

//if(!isset($_SESSION['regist'])){
//    header('Location:regist.php');
//    exit();
//}


require('dbconnect.php');
if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO users SET name=?,email=?,password=?,created_at=NOW()');
    $statement->execute(array(
            $_SESSION['regist']['name'],
            $_SESSION['regist']['email'],
            sha1($_SESSION['regist']['password']),
    ));
    unset($_SESSION['regist']);

    header('Location:create.php');
    exit();
}

?>

<?php require('head.php'); ?>
    <body>
    <?php require('header.php'); ?>
    <div class="container mt-5 pb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-5">
                    <h5 class="border-bottom mb-3 pb-2">新規登録（入力確認）</h5>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="submit" />
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>ニックネーム</label>
                                <p><?php echo htmlspecialchars($_SESSION['regist']['name'],ENT_QUOTES); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>メールアドレス</label>
                                <p><?php echo htmlspecialchars($_SESSION['regist']['email'],ENT_QUOTES); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label>パスワード</label>
                                <p>*************</p>
                            </div>
                        </div>
                        <div class="form-group d-md-flex">
                            <button class="btn btn-primary text-light px-4" type="submit">登録する</button>
                            <div class="mt-2 mt-md-0 ml-md-2"><a href="regist.php?action=rewrite" class="btn btn-secondary text-light px-4">修正</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>