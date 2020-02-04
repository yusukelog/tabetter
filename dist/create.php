<?php
session_start();
require('dbconnect.php');

if (!empty($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    // 現時刻の取得
    $date = date("Y-m-d");
    $time = date("H:i");

    $_SESSION['time'] = time();
    $users = $db->prepare('SELECT * FROM users WHERE id=?');
    $users->execute(array($_SESSION['id']));
    $user = $users->fetch();
} else {
    header('Location:/');
    exit();
}

if (!empty($_POST)) {
    $user = $user['id'];
    $category_id = (!empty($_POST['categoryRadio'])) ? $_POST['categoryRadio'] : NULL;
    $text = $_POST['text'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    if (!empty($_POST["text"]) && $_POST["text"] !== '') {
        $post = $db->prepare('INSERT INTO posts SET user_id=:u_id,category_id=:c_id,text=:text,date=:date,time=:time,created_at=NOW(),updated_at=NOW()');
        $post->execute(array(
            'u_id' => $user,
            'c_id' => $category_id,
            ':text' => $text,
            ':date' => $date,
            ':time' => $time,
        ));
        header('Location:create.php');
        exit();
    }
}

$posts = $db->query('SELECT p.*,c.category_name FROM posts as p LEFT JOIN category as c ON p.category_id=c.id ORDER BY p.created_at DESC LIMIT 5');

?>
<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="POST">
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-utensils mr-2"></i>たべたもの</label>
                    <textarea class="form-control" name="text" placeholder="パンケーキ" rows="3"></textarea>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-camera mr-2"></i>たべもの画像</label>
                    <div class="d-block">
                        <label class="d-inline-block btn btn-secondary text-light">
                            <i class="fas fa-plus-circle"></i>
                            <input type="file" class="d-none" name="img">
                        </label>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="far fa-clipboard mr-2"></i>カテゴリ</label>
                    <div class="d-block">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio1"
                                   value="1">
                            <label class="form-check-label" for="categoryRadio1">朝ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio2"
                                   value="2">
                            <label class="form-check-label" for="categoryRadio2">昼ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio3"
                                   value="3">
                            <label class="form-check-label" for="categoryRadio3">夜ごはん</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio4"
                                   value="4">
                            <label class="form-check-label" for="categoryRadio4">おやつ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="categoryRadio" id="categoryRadio5"
                                   value="5">
                            <label class="form-check-label" for="categoryRadio5">その他</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="far fa-clock mr-2"></i>たべた日時</label>
                    <div class="row">
                        <div class="col-md-4 mt-3 mt-md-0">
                            <input type="date" class="form-control" id="date" name="date"
                                   value="<?php echo htmlspecialchars($date, ENT_QUOTES); ?>">
                        </div>
                        <div class="col-md-3 mt-3 mt-md-0">
                            <input type="time" class="form-control" id="time" name="time"
                                   value="<?php echo htmlspecialchars($time, ENT_QUOTES); ?>">
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <button class="btn btn-secondary btn-block text-light" type="submit">今の日時を設定</button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <button class="btn btn-primary btn-lg text-light px-4" type="submit">登録する</button>
                </div>
            </form>
            <div class="mb-5">
                <label class="h5"><i class="far fa-list-alt mr-2"></i>履歴</label>
                <div>
                    <?php foreach ($posts as $post): ?>
                        <div class="border-bottom">
                            <h6 class="bg-secondary text-center text-light px-3 py-2">
                                <i class="far fa-calendar-alt mr-2"></i><?php echo date('Y年m月d日',strtotime(htmlspecialchars($post['date'],ENT_QUOTES))); ?>
                            </h6>
                            <div class="p-3 pb-5">
                                <div class="row justify-content-between">
                                    <div class="col-md-4">
                                        <div>
                                            <small>
                                                <i class="far fa-clipboard mr-1"></i><?php echo htmlspecialchars($post['category_name'],ENT_QUOTES); ?></small><small class="ml-2">
                                                <i class="far fa-clock mr-1"></i><?php echo date('G時i分',strtotime(htmlspecialchars($post['time'],ENT_QUOTES))); ?>
                                             </small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <form action="edit.php" method="POST">
                                            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id'],ENT_QUOTES); ?>">
                                            <button class="btn btn-primary btn-block text-light" type="submit">編集する</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="note-area mt-2">
                                    <?php echo nl2br(htmlspecialchars($post['text'],ENT_QUOTES)); ?>
                                </div>
                                <ul class="list-inline m-0 mt-3">
                                    <li class="list-inline-item">
                                        <img src="https://placehold.jp/80x80.png">
                                    </li>
                                    <li class="list-inline-item">
                                        <img src="https://placehold.jp/80x80.png">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="form-group text-center mt-4">
                    <a href="show.php" class="btn btn-secondary text-light px-5" type="submit">全ての履歴を見る</a>
                </div>
            </div>
        </div>
        <?php require('search.php'); ?>
    </div>
</div>
<?php require('footer.php'); ?>
