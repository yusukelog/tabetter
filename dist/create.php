<?php
session_start();
require('dbconnect.php');

// フラッシュメッセージ
$flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : array();
unset($_SESSION['flash']);

// ログイン状態の確認
if (!empty($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    // 現時刻の取得
    $date = date("Y-m-d");
    $time = date("H:i");

    $_SESSION['time'] = time();
    $users = $db->prepare('SELECT * FROM users WHERE id=?');
    $users->execute(array($_SESSION['id']));
    $user = $users->fetch();
    $user_id = $user['id'];
} else {
    header('Location:/');
    exit();
}

// 投稿処理
if (!empty($_POST)) {
    $user = $user['id'];
    $category_id = (!empty($_POST['categoryRadio'])) ? $_POST['categoryRadio'] : NULL;
    $text = $_POST['text'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    if (!empty($_POST["text"]) && $_POST["text"] !== '') {
        $post = $db->prepare('INSERT INTO posts SET user_id=:u_id,category_id=:c_id,text=:text,date=:date,time=:time,created_at=NOW(),updated_at=NOW()');
        $post->execute(array(
            ':u_id' => $user,
            ':c_id' => $category_id,
            ':text' => $text,
            ':date' => $date,
            ':time' => $time,
        ));

        // 登録したレコードid取得
        $id = $db->lastInsertId();

        // 画像保存
        $image = date('YmdHis') . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'],'./image/' . $image);
        $media = $db->prepare('INSERT INTO media SET post_id=:p_id,media=:media,created_at=NOW(),updated_at=NOW()');
        $media->execute(array(
            ':p_id' => $id,
            ':media' => $image,
        ));

        // 登録後のメッセージをセッション変数に格納（このやりかたブログに書く）
        $_SESSION['flash'] = '登録しました';

        header('Location:create.php');
        exit();
    }
}

$post = $db->prepare('SELECT p.*,c.category_name,m.media FROM posts as p LEFT JOIN category as c ON p.category_id=c.id LEFT JOIN media as m ON p.id=m.post_id WHERE p.user_id=:user_id ORDER BY p.created_at DESC LIMIT 5');
$post->execute(array(
    ':user_id' => $user_id,
));
$posts = $post->fetchAll();

?>
<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<?php if(!empty($flash)): ?>
    <div id="js-flash" class="alert alert-success">
        <?php echo $flash; ?>
    </div>
<?php endif; ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-utensils mr-2"></i>たべたもの</label>
                    <textarea class="form-control" name="text" placeholder="パンケーキ" rows="3"></textarea>
                </div>
                <div class="form-group mb-5">
                    <label class="h5"><i class="fas fa-camera mr-2"></i>たべもの画像</label>
                    <div class="d-block">
                        <div id="preview" class="mb-1"></div>
                        <label class="d-inline-block btn btn-secondary text-light">
                            <i class="fas fa-plus-circle"></i>
                            <input type="file" class="d-none" name="img" size="35" onChange="imgPreView(event)">
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
                            <button id="today" class="btn btn-secondary btn-block text-light" type="button">今の日時を設定</button>
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
                                    <div class="col-md-5">
                                        <div>
                                            <small>
                                                <i class="far fa-clipboard mr-1"></i><?php echo htmlspecialchars($post['category_name'],ENT_QUOTES); ?></small><small class="ml-2">
                                                <i class="far fa-clock mr-1"></i><?php echo date('G時i分',strtotime(htmlspecialchars($post['time'],ENT_QUOTES))); ?>
                                             </small>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-end">
                                            <form action="edit.php" method="POST">
                                                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id'],ENT_QUOTES); ?>">
                                                <button class="btn btn-primary btn-block text-light" type="submit">編集する</button>
                                            </form>
                                            <form action="delete.php" method="POST" class="ml-1" onsubmit="return submitChk()">
                                                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id'],ENT_QUOTES); ?>">
                                                <button class="btn btn-secondary btn-block text-light" type="submit">削除する</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="note-area mt-2">
                                    <?php echo nl2br(htmlspecialchars($post['text'],ENT_QUOTES)); ?>
                                </div>
                                <?php if(!empty($post['media'])): ?>
                                <ul class="list-inline m-0 mt-3">
                                    <li class="list-inline-item">
                                        <img src="/image/<?php echo htmlspecialchars($post['media'],ENT_QUOTES); ?>">
                                    </li>
                                </ul>
                                <?php endif; ?>
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
<script>
    // フラッシュメッセージ
    const flash = document.getElementById('js-flash')
    window.addEventListener('DOMContentLoaded',() => {
        flash.classList.add('fadeout')
        setTimeout(() => {
            flash.style.display = "none"
        },4000)
    })

    // ファイル選択画像プレビュー
    const imgPreView = event => {
        const file = event.target.files[0]
        const reader = new FileReader()
        const preview = document.getElementById("preview")
        const previewImage = document.getElementById("previewImage")

        if(previewImage != null) {
            preview.removeChild(previewImage)
        }
        reader.onload = () => {
            const img = document.createElement("img")
            img.setAttribute("src", reader.result)
            img.setAttribute("id", "previewImage")
            preview.appendChild(img)
        };

        reader.readAsDataURL(file)
    }

    // 現時刻の取得・設定
    const Today = document.getElementById("today")
    Today.addEventListener('click',() => {
        const now = new Date()
        const Year = now.getFullYear()
        const Month = ("0" + (now.getMonth() + 1)).slice(-2)
        const Day = ("0" + now.getDate()).slice(-2)
        const Hour = now.getHours()
        const Min = now.getMinutes()

        const date = document.getElementById("date")
        const time = document.getElementById("time")

        date.value = Year + '-' + Month + '-' + Day;
        time.value = Hour + ':' + Min;
    })


    const submitChk = () => {
        const flg = confirm("削除してもよろしいですか？")
        return flg
    }
</script>