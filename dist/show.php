<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-5">
                <h5><i class="far fa-list-alt mr-2"></i>履歴一覧</h5>
                <div>
                    <div class="border-bottom">
                        <h6 class="bg-secondary text-center text-light px-3 py-2">
                            <i class="far fa-calendar-alt mr-2"></i>2020年01月08日
                        </h6>
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
            </div>
        </div>
        <?php require('search.php'); ?>
    </div>
</div>
<?php require('footer.php'); ?>
