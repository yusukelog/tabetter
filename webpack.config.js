module.exports = {
    // モード値を production に設定すると最適化された状態で、
    // development に設定するとソースマップ有効でJSファイルが出力される
    mode: "development",
    entry: "./src/js/index.js",
    module: {
        rules: [
            {
                // 対象となるファイルの拡張子(cssのみ)
                test: /\.(sc|c)ss$/,
                // Sassファイルの読み込みとコンパイル
                use: [
                    // スタイルシートをJSからlinkタグに展開する機能
                    "style-loader",
                    // CSSをバンドルするための機能
                    "css-loader",
                    "sass-loader"
                ]
            }
        ]
    }
};