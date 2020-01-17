<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-search mr-2"></i>検索</h5>
            <div class="form-group mb-4">
                <label>キーワード</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group mb-4">
                <label>カテゴリ</label>
                <select class="form-control" id="categoryFormControlSelect1">
                    <option>すべてのカテゴリ</option>
                    <option>朝ごはん</option>
                    <option>昼ごはん</option>
                    <option>夜ごはん</option>
                    <option>おやつ</option>
                    <option>その他</option>
                </select>
            </div>
            <div class="form-group mb-4">
                <label>並び順</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sortRadios" id="sortRadios1" value="new"
                           checked>
                    <label class="form-check-label" for="sortRadios1">
                        日付の新しい順
                    </label>
                </div>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="radio" name="sortRadios" id="sortRadios2" value="old">
                    <label class="form-check-label" for="sortRadios2">
                        日付の古い順
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg text-light px-4" type="submit">検索する</button>
            </div>
        </div>
    </div>
</div>