<?php require('head.php'); ?>
<body>
<?php require('header.php'); ?>
<div class="container mt-5 pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5">
                <h5 class="border-bottom mb-3 pb-2">お問合せ</h5>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>お名前 (必須)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>メールアドレス (必須)</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>お問合わせ内容 (必須)</label>
                        <textarea class="form-control" rows="8"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>
