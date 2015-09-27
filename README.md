epigone
===
シンプルな WordPress テーマ。

迅速にコーディングを進めるために開発しています。

![](https://raw.githubusercontent.com/1shiharaT/epigone/master/screenshot.png)

## 特徴

* [Gulp](http://gulpjs.com/)
* [Bower](http://bower.io/)
* [BrowserSync](http://www.browsersync.io/)
* [Foundation](http://foundation.zurb.com/)
* [FontAwesome](http://font-awesome/)

## 必要なライブラリ

* node.js >= v0.12.4
* npm >= 2.0

## 地道な開発方法

### 1. インストール

WordPress のテーマディレクトリにコマンドライン、もしくは Git クライアントソフトウェアから git clone
してください。

    $ cd wp-content/themes/
	$ git clone https://github.com/1shiharaT/epigone.git epigone

もしくは、[ここ](https://github.com/1shiharaT/epigone/archive/master.zip)からダウンロード後、
解凍したディレクトリをテーマディレクトリに設置してください。

### 2. 依存パッケージのインストール

テーマディレクトリに移動し、依存しているパッケージをインストールします。

    $ cd wp-content/themes/epigone/
	$ npm run-script setup

上記のコマンドで、npm install, bower install, gulp build の3つのコマンドが走ります。
多少時間がかかりますが、我慢してください。

### 3. Gulp の設定

BrowserSyncの proxy_url を指定します。

gulp/config.js をテキストエディタで開き、URLを変更してください。

    // ここにURLを入力
    var url = "http://example.com";

watch タスクを実行するには、次のコマンドを実行してください。自動的にブラウザが立ち上がり、Sass, JavaScript の監視を開始します。

	$ gulp watch

## 独自テーマの開発

Yeoman の Generator を別途開発しています。

[generator-epigone](https://github.com/1shiharaT/generator-epigone)



