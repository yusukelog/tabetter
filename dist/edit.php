<?php
session_start();
require('dbconnect.php');

// ログイン状態の確認
if (!empty($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    // 現時刻の取得
    $date = date("Y-m-d");
    $time = date("H:i");

    $_SESSION['time'] = time();
//    $users = $db->prepare('SELECT * FROM users WHERE id=?');
//    $users->execute(array($_SESSION['id']));
//    $user = $users->fetch();
} else {
    header('Location:/');
    exit();
}

if (!empty($_POST)) {
    if (!empty($_POST["post_id"]) && $_POST["post_id"] !== '') {
        $posts = $db->prepare('SELECT p.*,c.category_name,m.media FROM posts as p LEFT JOIN category as c ON p.category_id=c.id  LEFT JOIN media as m ON p.id=m.post_id WHERE p.id=:p_id');
        $posts->execute(array(
            ':p_id' => $_POST["post_id"],
        ));
        $post = $posts->fetch();
    }

    if (!empty($_POST["text"]) && $_POST["text"] !== '') {
        $text = $db->prepare('UPDATE posts SET category_id=?,text=?,date=?,time=?,updated_at=NOW() WHERE id=?');
        $text->execute(array(
            $_POST['categoryRadio'],
            $_POST['text'],
            $_POST['date'],
            $_POST['time'],
            $_POST['post_id'],
        ));
        header('Location:create.php');
        exit();
    }
}

?>
<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="POST">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id'],ENT_QUOTES); ?>">
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-utensils mr-2"></i>たべたもの</label>
                    <textarea class="form-control" name="text" placeholder="パンケーキ" rows="3"><?php echo htmlspecialchars($post['text'],ENT_QUOTES); ?></textarea>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-camera mr-2"></i>たべもの画像</label>
                    <div class="d-block">
                        <?php if(!empty($post['media'])): ?>
                        <div class="mb-1">
                            <img src="/image/<?php echo htmlspecialchars($post['media'],ENT_QUOTES); ?>">
                        </div>
                        <?php else: ?>
                        <label class="d-inline-block btn btn-secondary text-light">
                            <i class="fas fa-plus-circle"></i>
                            <input type="file" class="d-none" name="img">
                        </label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="far fa-clipboard mr-2"></i>カテゴリ</label>
                    <div class="d-block">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio1"
                                   value="1" <?php if($post['category_id']==="1") echo 'checked'; ?>>
                            <label class="form-check-label" for="categoryRadio1">朝ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio2"
                                   value="2" <?php if($post['category_id']==="2") echo 'checked'; ?>>
                            <label class="form-check-label" for="categoryRadio2">昼ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio3"
                                   value="3" <?php if($post['category_id']==="3") echo 'checked'; ?>>
                            <label class="form-check-label" for="categoryRadio3">夜ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio4"
                                   value="4" <?php if($post['category_id']==="4") echo 'checked'; ?>>
                            <label class="form-check-label" for="categoryRadio4">おやつ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio5"
                                   value="5" <?php if($post['category_id']==="5") echo 'checked'; ?>>
                            <label class="form-check-label" for="categoryRadio5">その他</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="far fa-clock mr-2"></i>たべた日時</label>
                    <div class="row">
                        <div class="col-md-4 mt-3 mt-md-0">
                            <input type="date" class="form-control" id="date" name="date"
                                   value="<?php echo htmlspecialchars($post['date'], ENT_QUOTES); ?>">
                        </div>
                        <div class="col-md-3 mt-3 mt-md-0">
                            <input type="time" class="form-control" id="time" name="time"
                                   value="<?php echo htmlspecialchars($post['time'], ENT_QUOTES); ?>">
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <button class="btn btn-secondary btn-block text-light" type="submit">今の日時を設定</button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <button class="btn btn-primary btn-lg text-light px-4" type="submit">編集する</button>
                </div>
            </form>
        </div>
        <?php require('search.php'); ?>
    </div>
</div>
<?php require('footer.php'); ?>
