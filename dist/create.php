<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-5">
                <label class="h5"><i class="fas fa-utensils mr-2"></i>たべたもの</label>
                <textarea class="form-control" placeholder="パンケーキ" rows="3"></textarea>
            </div>
            <div class="form-group mb-5">
                <label class="h5"><i class="fas fa-camera mr-2"></i>たべもの画像</label>
                <div class="d-block">
                    <label class="d-inline-block btn btn-secondary text-light">
                        <i class="fas fa-plus-circle"></i>
                        <input type="file" class="d-none">
                    </label>
                </div>
            </div>
            <div class="form-group mb-5">
                <label class="h5"><i class="far fa-clipboard mr-2"></i>カテゴリ</label>
                <div class="d-block">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                               value="option1">
                        <label class="form-check-label" for="inlineRadio1">朝ごはん</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                               value="option2">
                        <label class="form-check-label" for="inlineRadio2">昼ごはん</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                               value="option3">
                        <label class="form-check-label" for="inlineRadio3">夜ごはん</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4"
                               value="option4">
                        <label class="form-check-label" for="inlineRadio4">おやつ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5"
                               value="option5">
                        <label class="form-check-label" for="inlineRadio5">その他</label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-5">
                <label class="h5"><i class="far fa-clock mr-2"></i>たべた日時</label>
                <div class="row">
                    <div class="col-md-4 mt-3 mt-md-0">
                        <input type="date" class="form-control" id="date">
                    </div>
                    <div class="col-md-3 mt-3 mt-md-0">
                        <input type="time" class="form-control" id="time">
                    </div>
                    <div class="col-md-4 mt-3 mt-md-0">
                        <button class="btn btn-secondary btn-block text-light" type="submit">今の日時を設定</button>
                    </div>
                </div>
            </div>
            <div class="form-group mb-5">
                <button class="btn btn-primary btn-lg text-light px-4" type="submit">登録する</button>
            </div>
            <div class="mb-5">
                <label class="h5"><i class="far fa-list-alt mr-2"></i>履歴</label>
                <div>
                    <div class="border-bottom">
                        <h6 class="bg-secondary text-light px-3 py-2"><i class="far fa-calendar-alt mr-2"></i>2020年01月08日</h6>
                        <div class="p-3">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    <div>
                                        <small><i class="far fa-clipboard mr-1"></i>昼ごはん</small><small class="ml-2"><i class="far fa-clock mr-1"></i>12:00</small>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary btn-block text-light" type="submit">編集する</button>
                                </div>
                            </div>
                            <div class="note-area mt-2">
                                パンケーキ<br>
                                アールグレイ
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
                    <div class="border-bottom">
                        <div class="p-3">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    <div>
                                        <small><i class="far fa-clipboard mr-1"></i>昼ごはん</small><small class="ml-2"><i class="far fa-clock mr-1"></i>12:00</small>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary btn-block text-light" type="submit">編集する</button>
                                </div>
                            </div>
                            <div class="note-area mt-2">
                                パンケーキアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイアールグレイ<br>
                                アールグレイ
                            </div>
                        </div>
                    </div>
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
