epigone
===
_s をベースとした、WordPressテーマです。

# Featured

* Gulp
* BrowserSync
* Profound Grid

# Require

* node.js
* gulp.js
* Sass >= 3.2.5

# Getting Started

### 1. テーマのインストール

テーマディレクトリ ( wp-content/themes/ ) に移動してgit clone してください。

	$ git clone https://github.com/1shiharaT/epigone.git epigone

または、[zipファイル](https://github.com/1shiharaT/epigone/archive/master.zip) をダウンロードして、テーマをインストールしてください。

### 2. npm パッケージのインストール

package.json ファイルのある階層で下記のコマンドを実行します。

	$ npm install

### 3. gulp の起動

1. gulpfile.js の BrowserSync の設定を変更

	// browser sync
	gulp.task('browserSync', function() {
	  browserSync.init(null, {
	    notify: true,
	    proxy: {
	      host: "your-domain.dev", // ドメインを変更
	      // port: 3333
	    },
	    // 好みによってghostMode の設定を変更してください。
	    ghostMode: {
	      clicks: true,
	      location: true,
	      forms: true,
	      scroll: false
	    }
	  });
	});

2. ターミナル から Gulp を起動

	$ gulp watch

上記でgulpが起動し、assets/js フォルダ内のjsファイル, assets/scss 内の scss ファイルを自動でコンパイルします。


