<?php
//--------------------------------------------------
// 「noReita」v3.0.0～用テーマ「monoreita」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------

//テーマ名
const THEME_NAME = "monoreita";

//テーマのバージョン
const THEME_VER = "3.0.0 lot.260405.0";

/* -------------------- */

//編集したときの目印
//※記事を編集したら日付の後ろに付きます
const UPDATE_MARK = ' *';

//名前引用時の「さん」
const A_NAME_SAN = 'さん';

//「そうだね」
const SODANE = 'そうだね';

/* -------------------- */

//テーマがXHTMLか 1:XHTML 0:HTML
const TH_XHTML = 0;

/* テンプレートファイル名に".blade.php"は不要 */

//メインのテンプレートファイル
const MAINFILE = "monoreita_main";

//レスのテンプレートファイル
const RESFILE = "monoreita_res";

//お絵かき(PaintBBS NEO/しぃペインター)のテンプレートファイル
const PAINTFILE = "monoreita_paint";

//お絵かき(chickenPaint/Klecks/Tegaki/Axnos)のテンプレートファイル
const PAINTFILE_BE = "monoreita_be";

//動画再生のテンプレートファイル
const ANIMEFILE = "monoreita_anime";

//投稿時のテンプレートファイル
const PICFILE = "monoreita_picpost";

//カタログ、検索モードのテンプレートファイル
const CATALOGFILE = "monoreita_catalog";

//管理モードのテンプレートファイル
const ADMINFILE = "monoreita_admin";

//SNSシェア選択のテンプレートファイル
const SET_SHARE_SERVER = "monoreita_sns_share";

//misskey関係のテンプレートファイル
const MISSKEYFILE = "monoreita_misskey_note";

//その他のテンプレートファイル
const OTHERFILE = "monoreita_other";

//描画時間の書式
//※日本語だと、"1日1時間1分1秒"
//※英語だと、"1day 1hr 1min 1sec"
const PTIME_D = '日';
const PTIME_H = '時間';
const PTIME_M = '分';
const PTIME_S = '秒';

//＞が付いた時の書式
//※RE_STARTとRE_ENDで囲むのでそれを考慮して
//ここは変更せずにcssで設定するの推奨
const RE_START = '<span class="resma">';
const RE_END = '</span>';

//エラーメッセージ
const MSG001 = "該当記事がみつかりません[Log is not found.]";
const MSG002 = "絵が選択されていません[Picture has not been selected.]";
const MSG003 = "アップロードに失敗しました[It failed in up-loading.]<br>サーバーがサポートしていない可能性があります[There is a possibility that the server doesn't support it.]";
const MSG004 = "アップロードに失敗しました[It failed in up-loading.]<br>画像ファイル以外は受け付けません[It is not accepted excluding the picture file.]";
const MSG005 = "アップロードに失敗しました[It failed in up-loading.]<br>同じ画像がありました[The same image existed.]";
const MSG006 = "不正な投稿です[Please do not do an illegal contribution.]<br>POST以外での投稿は受け付けません[The contribution excluding 'POST' is not accepted.]";
const MSG007 = "画像がありません[no image.]";
const MSG008 = "何か書いて下さい[write something.]";
const MSG009 = "名前がありません[no name.]";
const MSG010 = "題名がありません[no subject]";
const MSG011 = "本文が長すぎます[comment is too long.]";
const MSG012 = "名前が長すぎます[name is too long.]";
const MSG013 = "メールアドレスが長すぎます[email is too long.]";
const MSG014 = "題名が長すぎます[subject is too long.]";
const MSG015 = "異常です[Abnormality]";
const MSG016 = "拒絶されました[was rejected.]<br>そのHOSTからの投稿は受け付けません[Post from the 'HOST' is not accepted.]";
const MSG017 = "ERROR！[Error]　公開PROXY規制中！！[Open-PROXY is limited.](80)";
const MSG018 = "ERROR！[Error]　公開PROXY規制中！！[Open-PROXY is limited.](8080)";
const MSG019 = "ログの読み込みに失敗しました[It failed in reading the log.]";
const MSG020 = "連続投稿はもうしばらく時間を置いてからお願い致します[Please wait for a continuous post for a while.]";
const MSG021 = "画像連続投稿はもうしばらく時間を置いてからお願い致します[Please wait for a continuous post of the image for a while.]";
const MSG022 = "このコメントで一度投稿しています[Post once by this comment.]<br>別のコメントでお願い致します[Please put another comment.]";
const MSG023 = "ツリーの更新に失敗しました[It failed in the renewal of the tree.]";
const MSG024 = "ツリーの削除に失敗しました[It failed in the deletion of the tree.]";
const MSG025 = "スレッドがありません[no thread.]";
const MSG026 = "スレッドが最後の1つなので削除できません[thread is the last one, not delete.]";
const MSG027 = "削除に失敗しました(ユーザー)[failed in deletion.(User)]";
const MSG028 = "該当記事が見つからないかパスワードが間違っています[article is not found or password is wrong.]";
const MSG029 = "パスワードが違います[password is wrong.]";
const MSG030 = "削除に失敗しました(管理者権限)[failed in deletion.(Admin)]";
const MSG031 = "記事Noが未入力です[Please input No.]";
const MSG032 = "拒絶されました[was rejected.]<br>不正な文字列があります[illegal character string.]";
const MSG033 = "削除に失敗しました[failed in deletion.]<br>ユーザーに削除権限がありません[user doesn't have deletion authority.]";
const MSG034 = "アップロードに失敗しました[It failed in up-loading.]<br>規定の画像容量をオーバーしています[size over is picture file.]";
const MSG035 = "何か日本語で書いてください[Comment should have at least some Japanese characters.]";
const MSG036 = "本文にそのURLを書く事はできません。[This URL can not be used in text.]";
const MSG037 = "予備";
const MSG038 = "予備";
const MSG039 = "予備";
const MSG040 = "予備";
