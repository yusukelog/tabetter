<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">カテゴリー変更</h5>
                <div class="row align-items-baseline">
                    <p class="col-md-4">
                        <input type="text" class="form-control" value="朝ごはん">
                    </p>
                    <p>（20文字以内）</p>
                </div>
                <div class="row align-items-baseline">
                    <p class="col-md-4">
                        <input type="text" class="form-control" value="朝ごはん">
                    </p>
                    <p>（20文字以内）</p>
                </div>
                <div class="row align-items-baseline">
                    <p class="col-md-4">
                        <input type="text" class="form-control" value="朝ごはん">
                    </p>
                    <p>（20文字以内）</p>
                </div>
                <div class="row align-items-baseline">
                    <p class="col-md-4">
                        <input type="text" class="form-control" value="朝ごはん">
                    </p>
                    <p>（20文字以内）</p>
                </div>
                <div class="row align-items-baseline">
                    <p class="col-md-4">
                        <input type="text" class="form-control" value="朝ごはん">
                    </p>
                    <p>（20文字以内）</p>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary text-light px-4" type="submit">変更する</button>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">メールアドレス変更</h5>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>新しいメールアドレス</label>
                        <input type="text" class="form-control" value="xxxx@xxx.com">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary text-light px-4" type="submit">変更する</button>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">パスワード変更</h5>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>新しいパスワード（半角英数字5文字以上）</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>新しいパスワード（再入力）</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary text-light px-4" type="submit">変更する</button>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">退会</h5>
                <div class="form-group">
                    <button class="btn btn-primary text-light px-4" type="submit">退会する</button>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">お問合せ</h5>
                <div class="form-group">
                    <a class="btn btn-primary text-light px-4" type="submit">お問合せフォームへ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>
