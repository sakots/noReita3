<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------


/*設定項目*/

/*-----絶対に変更が必要な項目-----*/

// 管理者パスワード 必ず変更してください。初期設定のままでは動かないようにしています。
const ADMIN_PASS = "admin_password_change_me";

// 第2パスワード 必ず変更してください。
// 管理者投稿や管理者削除の時に管理者である事を再確認する為に使うパスワード。
//システムの内部で使用するため覚えておく必要はありません。
// 管理パスと同じパスワードは使えません。
const SECOND_PASS = "wGmG8ndWgEui6Ypm";

// この掲示板の名前
const BOARD_NAME = "おえかき掲示板 noReita3";

// 掲示板からの戻り先のホームページの名前
// 空欄なら｢ホーム｣と表示されます。
const SITE_NAME = "";

// ホームページ(掲示板からの戻り先)
const HOME_URL = "./"; //相対パス、絶対パス、URLどれでもOK

// 最大スレッド保存件数 この数値以上のスレッドは削除されます
// 最低500スレッド。
const MAX_LOG = 5000;

// メール通知のほか、シェアボタンなどで使用
// 設置場所のurl `/`まで。
const ROOT_URL = "http://example.com/oekaki/";

// 名前を必須にする
// する: 1 しない: 0
const NAME_INPUT_REQUIRED = 1;

// 名前が必須でないときのデフォルトの名前
const DEFAULT_NAME = "名無しさん";

// スレッドの題名を必須にする
// する: 1 しない: 0
const SUBJECT_INPUT_REQUIRED = 0;

// 本文を必須にする
// する: 1 しない: 0
const COMMENT_REQUIRED = 0;

// 本文の制限文字数。半角で
const MAX_COMMENTS_LENGTH = 1000;

/*-----絶対に変更が必要な項目ここまで-----*/

/*データベース名*/
// データベースファイル名 拡張子は.dbで自動的に作成されます。
const DATABASE_NAME = "noreita3";

/*SNS連携*/

// SNS共有ボタンを使う
// スレッドのURLと内容をSNSにシェアできます。
// 使う: 1 使わない: 0
const SNS_SHARE_BUTTON = 1;

/*テーマ切り替え*/

// テーマのディレクトリ`/`まで 初期値 "mono3/"
const THEME_DIR = "mono3/";

/*掲示板の説明文*/

// テンプレートに直接記入しても構いませんが、ここで入力する事もできます。
// 説明文が1行なら ['説明そのいち']
// 説明文が3行なら ['説明そのいち','説明そのに','説明そのさん']
// 文字をクオートで囲って、カンマで区切ります。
// 説明文が不要なら []で。

const BOARD_DESCRIPTIONS = ['iPadやスマートフォンでも描けるお絵かき掲示板です。','楽しくお絵かき。','<a href="https://github.com/sakots/noReita3">スクリプトのソースはこちら</a>'];


/*メール通知*/

// 投稿をメールで通知する
// する: 1 しない: 0
const EMAIL_NOTICE = 0;

// 投稿があった事を通知するメールアドレス
const MAIL_ADDRESS = "example@example.com";

/*スパム対策*/
// 本文に日本語がなければ拒絶 する:1 しない:0
const JAPANESE_FILTER = 1;

// 拒絶する文字列 正規表現
// 設定しないなら[]で。
// 管理者は設定に関わらず投稿可能
const BAD_STRINGS = ['example.example.com','未承諾広告'];

// 拒絶するurl
// 管理者は設定に関わらず投稿可能
const BAD_URLS = ['example.com','www.example.com'];

// 使用できない名前 正規表現
// 管理者は設定に関わらず投稿可能
// 使用出来ない名前に管理者の名前を追加する事を強く推奨します。
// 管理者へのなりすましを防止できます。
const BAD_NAMES = ['管理人','ブランド','通販','販売','口コミ'];

// この中の2つ以上があれば投稿できない文字列 正規表現
// 管理者は設定に関わらず投稿可能
const BAD_STRING_COMBINATIONS = ['激安','低価','コピー','品質を?重視','大量入荷','シャネル','シュプリーム','バレンシアガ','ブランド'];

// 禁止ホスト
const BANNED_HOSTS = ["bad.example.com","spam.example.org"];

// ホスト名が逆引きできないIPアドレスからの投稿を拒絶する
// する: 1 しない: 0
// ※逆引きできないIPアドレスの利用者も多いため、
// 1 にすると一部の正当なユーザーが投稿できなくなる可能性があります。
const REJECT_IF_NO_REVERSE_DNS = 0;

// 禁止ホストからのアクセスがあった時は、SESSIONにキャッシュする
// する: 1 しない: 0
const USE_BANNED_HOST_SESSION_CACHE = 0;
// ※禁止ホスト判定をセッションに保存します。
// 禁止ホスト判定されるとブラウザを再起動するまで解除されません。

/*使用目的別設定*/

// ホームページへ戻るリンクを上段のメニューに表示する
// ホームページへのリンクが必要ない場合は 表示しない:0
// 表示する: 1 表示しない: 0
const DISPLAY_LINK_BACK_HOME = 1;

// PaintBBS NEOを使う
// 使う: 1 使わない: 0
const USE_PAINTBBS_NEO = 1;

// Tegakiを使う
// 使う: 1 使わない: 0
const USE_TEGAKI = 1;

// Axnos Paintを使う
// 使う: 1 使わない: 0
const USE_AXNOS_PAINT = 1;

// litaChixを使う
// 使う: 1 使わない: 0
const USE_LITACHIX = 1;

// Klecksを使う
// 使う: 1 使わない: 0
const USE_KLECKS = 1;

// 本文へのURLの書き込みを許可する
// URLを書き込むスパムを排除する時は しない: 0
// 管理者は設定に関わらず本文にURLを書き込めます。
// する: 1 しない: 0
const ALLOW_COMMENTS_URL = 1;

// URL入力欄を使用する
// 管理者は設定に関わらずURL入力欄を使用できます
// する: 1 しない: 0
const USE_URL_INPUT_FIELD = 1;

// URLを自動リンクする
// マークダウン記法も使えます。[リンクの文字](https://example.com/)
// する: 1 しない: 0
const USE_AUTO_LINK_URLS = 1;

// 添付画像アップロード機能を使う
// 管理者投稿モード(日記)でログインしている時は使わないに設定しても、
// ファイルアップロードが可能です。
// 使わないに設定すると、掲示板トップやリプ画面からの画像アップロードを使用しない設定になります。
// コメントのみの新規投稿を許可しない
// そして画像アップロード機能も使わない設定の場合はトップの入力フォームが表示されなくなります。
// 使う: 1 使わない: 0
const USE_UPLOAD = 1;

// リプで画像のアップロード機能や、お絵かき機能を使う
// 管理者投稿モード(日記)でログインしている時は使わないに設定しても、
// リプでお絵かきやリプ画像のファイルアップロードが可能です。
// 使う: 1 使わない: 0
const USE_REPLY_UPLOAD = 1;

// コメントのみの新規投稿を許可する、しない。
// しない: 0 で、スレ立てに画像が必須になります。
// コメントのみの新規投稿を許可しない、
// そして画像アップロード機能も使わない設定の場合はトップの入力フォームが表示されなくなります。
// する: 1 しない: 0
const ALLOW_COMMENTS_ONLY = 0;

// 日記モードを使用する
// する: 1 でスレッド立ては管理者のみになります。
// する: 1 しない: 0
const DIARY_MODE = 0;

// 返信を管理者のみに限定する
// する: 1 で管理者以外返信ができなくなります。
// 日記モードと併用すれば、すべての書き込みが管理者のみになります。
const ONLY_ADMIN_CAN_REPLY = 0;

// 年齢制限付きの掲示板として設定する
// する: 1 に設定すると確認ボタンを押すまで画像にぼかしが入ります。
// する: 1 しない: 0
const NSFW_BOARD = 0;

// 年齢確認を必須にする
// する: 1 で掲示板のすべてのコンテンツの閲覧に年齢確認が必要になります。
// あなたは18才以上ですか？という年齢確認確認画面が表示されます。
// 年齢確認画面以外のコンテンツは検索エンジンから認識されなくなります。
// する: 1 しない: 0
const AGE_CHECK_REQUIRED_TO_VIEW = 0;

// ｢18才未満です。｣を押した時のリンク先
const URL_FOR_UNDERAGE = "https://www.google.com/";

// 個別画像の閲覧注意を設定する
// する: 1 に設定すると投稿した個別画像を閲覧注意に設定できるようになります。
// 投稿時に｢閲覧注意にする｣を選択すると画像にぼかしが入ります。
// する: 1 しない: 0
const MARK_NSFW = 1;

// ｢閲覧注意にする｣をデフォルトでチェックする
// する: 1 に設定すると｢閲覧注意にする｣設定のチェックボックスがデフォルトでチェックされます。
// する: 1 しない: 0
const DEFAULT_NSFW_CHECKED = 0;

// すべての画像を閲覧注意に設定する
// する: 1 に設定するとすべての画像が閲覧注意になります。
// 投稿時の｢閲覧注意に設定する｣のチェックボックスは表示されません。
// する: 1 しない: 0
const SET_ALL_IMAGES_NSFW = 0;

// 描画時間の非表示設定
// する: 1 で投稿時に描画時間の表示/非表示を切り替える事ができるようになります。
// する: 1 しない: 0
const USE_HIDE_DRAWING_TIME = 0;

// すべての描画時間を非表示にする
// する: 1 ですべての投稿の描画時間を非表示にします。
// 管理者は設定に関わらず描画時間を表示できます。
const HIDE_ALL_DRAWING_TIME = 0;

// ユーザーIDを非表示にする
// する: 1 ですべての投稿のユーザーIDを非表示にします。
// 管理者は設定に関わらずユーザーIDを表示できます。
const HIDE_USER_ID = 0;

// 編集しても投稿日時を変更しないようにする
// 日記などで日付が変わると困る人のための設定
// する: 1 に設定すると編集しても投稿日時が変わりません。 通常は しない: 0。
// する: 1 しない: 0
const DO_NOT_CHANGE_POSTS_TIME = 0;

// リプがついてもスレッドがあがらないようにする
// する: 1 に設定するとリプライがついてもスレッドがあがりません。(全てsage)。
// 初期値 0
const DO_NOT_BUMP_THREADS = 0;

// 管理者を認証する
// する: 1 で、管理者の投稿の時は認証マークが出ます。初期テンプレートではチェックマーク。
// 管理者モードでログイン、またはパスワード一致の時に管理者と判定します。
// する: 1 しない: 0
const VERIFY_ADMIN_POSTS = 1;

// レス画面に前後のスレッドの画像を表示する
// する: 1 しない: 0
const SHOW_PREV_NEXT_THREAD_IMAGES = 1;

// 管理者ページに最新のリリースのバージョンとリンクを表示する
// する: 1 しない: 0
const DISPLAY_LATEST_RELEASE = 1;

// 続きを描く時は新規投稿でもパスワードを必須にする
// する: 1 しない: 0
// しない: 0 に設定すると、元の画像を上書きしない新規投稿なら
// 誰でも続きを描く事ができるようになります。
// 合作の時にパスワードを公開する必要はありません。
const PASSWORD_REQUIRED_TO_CONTINUE = 0;

// スレッド内のコメントを新着順に並び替える
// する: 1 しない: 0
// 初期値 0
const SORT_COMMENTS_BY_NEWEST = 0;

/*表示件数*/

// 1ページに表示するスレッド数
const THREADS_DEFAULT = 10;

// 1スレッドに返信できるリプの数
// 管理者による投稿はこの制限を受けません。
const MAX_REPLIES = 100;

// 1スレッドに表示するリプの数
// 返信画面では全て表示します。
// 設定しないなら 0 で。
const REPLY_THRESHOLD = 10;

// カタログモード時の1ページあたりの表示件数
const CATALOG_DEFAULT = 60;

/*画像関連*/

// 投稿できる画像の容量上限 単位kb
const MAX_KB = 2048;

// 投稿できる画像の幅と高さの上限 単位px これ以上は縮小
// 縮小されるのはアップロード画像のみ。お絵かきの制限値はここのすぐ下の設定項目で。
const MAX_PIXEL = 2048;

// お絵かきできる幅と高さのデフォルトサイズ
// 前回使用時の値がCookieに存在する時は、Cookieの値が使用されます。
const DEFAULT_CANVAS_WIDTH = 400; //幅
const DEFAULT_CANVAS_HEIGHT = 400; //高さ

// お絵かきできる幅と高さの最小サイズ
const MIN_CANVAS_WIDTH = 100; //幅
const MIN_CANVAS_HEIGHT = 100; //高さ

// お絵かきできる幅と高さの最大サイズ
const MAX_CANVAS_WIDTH = 800; //幅
const MAX_CANVAS_HEIGHT = 800; //高さ

// スレッド親画像の表示する幅と高さの最大サイズ
const THREAD_MAX_WIDTH = 800; //幅
const THREAD_MAX_HEIGHT = 800; //高さ

// スレッドのレスの表示する幅と高さの最大サイズ
const REPLY_MAX_WIDTH = 300; //幅
const REPLY_MAX_HEIGHT = 300; //高さ

// 表示する幅と高さの最大サイズを超える時はサムネイルを作成する
// する: 1 しない: 0
const USE_THUMBNAIL = 1;

// アップロード時にpng形式で保存する最大ファイルサイズ
// このファイルサイズを超える時はwebpに変換(単位kb)
const UPLOAD_PNG_THRESHOLD = 1024;

// ペイント時にpng形式で保存する最大ファイルサイズ
// このファイルサイズを超える時はwebpに変換(単位kb)
const PAINT_PNG_THRESHOLD = 1024;

/*合言葉設定*/

// 投稿に合言葉を必須にする
// する: 1 で投稿に合言葉が必要になります。
// する: 1 しない: 0
const USE_COUNTERSIGN = 0;

// 掲示板の閲覧に合言葉を必須にする
// する: 1 しない: 0
// する: 1 で掲示板のすべてのコンテンツの閲覧に合言葉が必要になります。
// 合言葉確認ページ以外のコンテンツは検索エンジンから認識されなくなります。
const COUNTERSIGN_REQUIRED_TO_VIEW = 0;

// 合言葉
// 上記の合言葉機能のどちらか、あいるは両方が 1 の時に入力する秘密の答え。
// 必要に応じて変更してください。
const COUNTERSIGN = "ひみつ";

// 合言葉のログイン状態を維持する
// する: 1 しない: 0
// する: 1 に設定すると合言葉のログイン状態を30日間維持します。
const KEEP_COUNTERSIGN_LOGIN_STATUS = 0;

/*検索機能*/

// 検索のリンクを上段のメニューに表示する
// する: 1 しない: 0
const DISPLAY_SEARCH_NAV = 0;

// 検索可能最大数
// この値を大きくすれば検索可能件数が増えます。
const MAX_SEARCH = 500;

// 画像検索の時の1ページあたりの表示件数
const SEARCH_IMAGES_DEFAULT = 60;

// 通常検索の時の1ページあたりの表示件数
const SEARCH_COMMENTS_DEFAULT = 30;

/*セキュリティ*/

// 管理者パスワードを5回連続して間違えた時は拒絶する
// する: 1 しない: 0
// 1にするとセキュリティは高まりますが、ログインページがロックされた時の解除に手間がかかります。
const CHECK_PASSWORD_INPUT_ERROR_COUNT = 0;

// ftp等でアクセスして、
// theme/errorlog/error.log
// を削除すると、再度ログインできるようになります。
// このファイルには、間違った管理者パスワードを入力したクライアントのIPアドレスが保存されています。
// 上記ファイルは手動で削除しなくても、ロック発生から3日経過すると自動的に削除され、
// ロックが解除されます。
// また、 しない: 0 に設定しなおせば上記ファイルは削除され、ロックが解除されます。


// お絵かきアプリで投稿する時の必要最低限の描画時間
// (単位:秒)。この設定が不要な時は : 0 に。
// 指定した秒数に達しない場合は、描画に必要な秒数を知らせるアラートが開きます。
const MINIMUM_DRAWING_TIME = 5;

/*詳細設定*/

// 古いスレッドを自動的に閉じる日数 単位 日
// 古いスレッドへのスパム防止
// 初期設定の180で、半年前に立てられたスレッドに返信できなくなります。
// 日数による制限をしない時は 0 。
// 管理者投稿はこの制限を受けません。
const ELAPSED_DAYS = 360;

// すべての投稿を拒否する
// 管理人長期不在、展示のみなど。
// する: 1で、すべての投稿ができなくなります。 初期値 0。
// する: 1 しない: 0
const DENY_ALL_POSTS = 0;

//タイムゾーン 日本時間で良ければ初期値 "asia/tokyo"

date_default_timezone_set("asia/tokyo");

// iframe内での表示を 拒否する
// 拒否する: 1 許可する: 0
// セキュリティリスクを回避するため "拒否する: 0" を強く推奨。
const INLINE_FRAME_OPTIONS_DENY = 1;

// SNSシェア機能詳細設定

// シェア機能に、Mastodon、Misskeyの各サーバを含める
// 含める: 1 含めない: 0
const INCLUDE_SNS_SERVERS_IN_SHARE = 1;

// SNS共有の時に一覧で表示するサーバ
// 例 	["表示名","https://example.com (SNSのサーバのurl)"],(最後にカンマが必要です)

const SERVERS =
[
	["X","https://x.com"],
	["Bluesky","https://bsky.app"],
	["Threads","https://www.threads.net"],
	["pawoo.net","https://pawoo.net"],
	["fedibird.com","https://fedibird.com"],
	["misskey.io","https://misskey.io"],
	["xissmie.xfolio.jp","https://xissmie.xfolio.jp"],
	["misskey.design","https://misskey.design"],
	["nijimiss.moe","https://nijimiss.moe"],
	["sushi.ski","https://sushi.ski"],
];

// SNS共有の時に開くWindowsの幅と高さ

// windowの幅 初期値 600
const SNS_WINDOW_WIDTH = 600;

// windowの高さ 初期値 600
const SNS_WINDOW_HEIGHT = 600;

// Misskey投稿機能設定

// Misskeyへの投稿機能を有効にする
// する: 1 しない: 0
const USE_MISSKEY_NOTE = 1;
$use_misskey_note = true;

//Misskeyへの投稿時に一覧で表示するMisskeyサーバ
const MISSKEY_SERVERS =
[
	["misskey.io","https://misskey.io"],
	["xissmie.xfolio.jp","https://xissmie.xfolio.jp"],
	["misskey.design","https://misskey.design"],
	["nijimiss.moe","https://nijimiss.moe"],
	["misskey.art","https://misskey.art"],
	["oekakiskey.com","https://oekakiskey.com"],
	["misskey.gamelore.fun","https://misskey.gamelore.fun"],
	["novelskey.tarbin.net","https://novelskey.tarbin.net"],
	["tyazzkey.work","https://tyazzkey.work"],
	["sushi.ski","https://sushi.ski"],
	["misskey.delmulin.com","https://misskey.delmulin.com"],
	["side.misskey.productions","https://side.misskey.productions"],
	["mk.shrimpia.network","https://mk.shrimpia.network"],
];

//SESSION名を独自性のあるものに変更する事で、セキュリティを向上させる事ができます。
//システムの内部で使用するため覚えておく必要はありません。
const SESSION_NAME = "session_noreita";

//セッション名は数字だけで構成することはできません。 少なくとも文字がひとつ以上現れる必要があります。そうでない場合、 新規セッション ID が毎回生成されます。
//https://www.php.net/manual/ja/function.session-name.php

/* 通常は変更しません*/

// スキップして表示しないレスの配列も取得する
// する: 1 しない: 0

// しない: 0 に設定すると表示しないレスの配列を取得しないため、表示を高速化できます。
const FETCH_ARTICLES_TO_SKIP = 0;

// ペイント画面の$pwdの暗号化
const CRYPT_PASS = "v25Xc9nZ82a5JPT"; //暗号鍵初期値
const CRYPT_METHOD = "aes-128-cbc";
const CRYPT_IV = "4HxFoxtvKL5Qr4xy"; //半角英数16文字

/*変更不可*/

// 変更しないでください

// テンポラリ
const TEMP_DIR = "temp/";
// 画像
const IMAGE_DIR = "img/";
// サムネイル
const THUMBNAIL_DIR = "thumbnail/";

//設定ファイルバージョン
const CONFIG_VER = 20251202;