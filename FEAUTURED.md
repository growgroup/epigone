# コンセプト
*  制作者に優しいテーマ

# 収益モデル

* 更新機能
* 追加機能プラグイン

# 必要な要件

* PHP 5.3 対応

* プラグインと別途開発
	* プラグインに搭載する機能
		* フロントエンドエディター

* 開発者に優しいテーマ作成
	* コーディングルールから実際のソースまで一環
	* PHPDocs に対応
	* yeoman generator の作成
	* pattern labを利用したスタイルガイドの作成

* 有効化時のアクション

* ドキュメントの充実

* 投稿順番のドラッグ&ドロップ

* ワンクリック子テーマ作成機能
	* 設定を選択後、それに沿った子テーマを作成できる機能
	* カラーなど

* 画像置換機能
	* テーマテンプレートに直書きしている画像もGUIで変更できるように

* キャッシュ機能の開発

* デザインファイルも作成する
	* psd, Illutrator, sketch の3種類のデザインファイルを作成

* レスポンシブwebデザイン対応
	* SMP、タブレット、PCごとに最適化された表示
	* 表示崩れ等をなくす

* 管理画面カスタマイズ
	* より編集しやすいように
	* ヘルプを充実させるか、ポインターAPIを使用するか。

* テーマカスタマイザー
	* スマートフォン、タブレットプレビュー機能
	* ページのレイアウト
		* グローバルで設定できるレイアウトと
		  記事毎に設定をできるレイアウト変更設定を設ける
	* テーマカラー
		* プライマリ、セカンダリ、ターシャリの3つの機能を設ける
	* フォントサイズの変更
	* 各見出しパターンの作成

* フロントエンド編集機能
	* TinyMCEを使用するか、コンテンツブロック型のエディターを実装するか

* スライダー機能
	 * スライダーを作成出来る機能を作成する

* カスタムフィールド
	* SEO 設定
	* リダイレクト機能
	* ソーシャルシェア

* ウィジェット
	* 子ページ一覧ウィジェット
	* ビジュアルエディタウィジェット
	* ページ毎表示設定ウィジェット


* デザインパターン
	* ベーシック
	* コーポレート
	* ブログ
	* メディア
	* ポートレート
	* モダン

* お問い合わせフォーム

* テーマ更新機能

* デザインモジュール
  *  グローバル
		* ヘッダー
		* フッター
		* ナビゲーション
		* サイドバー
		* ボタン
		* ウィジェット
		* フォーム
			* input[type=text,url,password]
			* input[type=radio,checkbox]
			* textarea
			* button,input[type=submit]
		* テキスト
			* リンク
			* 引用
	* 投稿ページ
		* 投稿タイトル
		* 投稿メタ情報
			* 著者
			* 日付
			* タクソノミー
			* 投稿フォーマット
		* コメントフォーム
		* HTMLエレメント
			* h1~h6
			* p
			* a
			* bloackquote
			* strong,small,em
			* figure
		* SNSシェア
		* 関連記事
		* この記事を書いた人
		* ページナビゲーション
	* アーカイブ
		* ページングナビ
		* アーカイブタイトル
		* 投稿ブロック
			* 投稿タイトル
			* 日付
			* 抜粋文
	* 固定ページ
		* 投稿とほぼ共通

# Pattern lab

* Atom : 最も細分化したデザインモジュール
	* Global : プロジェクト全体で使用することになるモジュール
		* Colors : 色
		* Fonts : プライマリーフォント、セカンダリフォント
		* Animations : アニメーション
		* Visuallity : 表示設定。画面サイズに応じて表示、非表示のクラスを作成
	* Text : テキストに関するデザインモジュール
		* Headings : h1 から h6 への見出しの設定
		* Paragraph : 段落に関する設定。行間、字間等
		* Blockquote : 引用のスタイル。
		* Inline Element : インラインタグのスタイル。a,small,em,strong,i,b,u,samp,code,mark,dfn,cite,q,abbr,sub,ins,code,time
		* Preformatted Text : 整形済みテキスト
		* Hr : 水平の罫線
	* List : リストのスタイル
		* Unordered : 通常のリストスタイル
		* Ordered : 数字付きリストスタイル
		* Definition : 定義リスト
	* Image : 画像に関するスタイル
		* Logo : ロゴ画像のスタイル
		* Squere : 真四角な画像のスタイル
		* Avatar :  プロフィール画像のスタイル
		* icons : アイコン
		* Loading icon : ローディングアイコン
		* Favicon : ファビコンのスタイル
	* Form : フォームのスタイル
		* Text field : input[type=text],input[type=pasword],input[type=url],input[type=email],input[type=search],input[type=number],エラー、成功時
		* Select Menu : セクレトボックス
		* Checkbox : チェックボックス
		* Radio Button : ラジオボタン
		* HTML5 Input : HTML5で新たに定義されたinputたぐ　
			* Color
			* Number
			* Range
			* Date
			* Mounth
			* Datatime
			* Datetime-local
		* Button : ボタンのスタイル
			* 通常
			* 非有効化時
			* テキストボタン
		*
  * Table : テーブルに関するマークアップ
*  Molecules : Atomを組み合わせてできるデザイン単位
	* Text
		* Byline : 著者名
		* Address : 住所
		* Heading Group : 見出しとサブテキストを合わせた見出しグループ
		* Blockquote Width Citation : 引用に誰からか、どの文献からの引用かを表す
		* Intro Text : リード文となる文章のスタイル
	* Layout : グリッドとなるスタイル
		* One up : 1カラム時のスタイル
		* Two Up : 2カラム
		* Three up : 3カラム
		* Four up : 4カラム
	* Block : テキストと画像、レイアウト、見出しを組み合わせた、ブロックとなる要素グループのスタイル
		* Media Block : 画像、見出し、テキストが合わさったブロック
		* Block Headline Byline : 見出しと署名が組み合わさったブロック
		* Block Hero : サイトのメインビジュアルなど
		* Block Thumb Headline : 画像と見出しの組み合わせ
		* Block Headline : 見出しのみのブロック
		* Block Inset :  ブロックと見出しが重なり合うパターン
	* Media : 画像等のスタイル
		* Figure Width Caption : 画像とキャプションテキストのパターン
	* Form : フォーム要素が組み合わさってできるデザインパーツ
		* Search : 検索フォーム。ボタンと、検索インプットの組み合わせ
		* Comment Form :  コメントフォームのスタイル
		* News Letter : ニュースレター登録のフォームの組み合わせ
	* Navigation : サイトで使用するナビゲーションのスタイル
		* Primary Nav :  グローバルナビゲーション
		* Footer Nav : フッターナビゲーション
		* Breadcrumbs : パンくずリスト
		* Pagination : ページネーション
		* Post Navigation : 投稿ナビゲーション
		* Tabs : タブナビゲーション
	* Component : 部品となるスタイルの組み合わせ
		* Social Share : SNSシェアボタンのスタイル
		* Accordion : アコーディオンメニュー
		* Single Comment : コメント一覧の一つのコメントの表示スタイル
	* Messaging : サイトからユーザーへのメッセージを表示するブロックのスタイル
* Organisms : 分子を組み合わせて作る、生物となるデザインパーツ
	* Global : ページに共通して利用するデザインパーツ
		* Header :  ヘッダー
		* Footer : フッター
	* Article : 記事本文のスタイル
	* Comment Thread : コメントフォーム、コメント一覧のスタイル
	* Section : セクショニングコンテンツ
		* Latest Posts :最新の記事一覧
		* Recent Tweets : 最新のツイート
		* Related Posts : 関連する記事一覧
* Template : ページを作成する上でもととなるテンプレート

* Pages : 実際のページ
