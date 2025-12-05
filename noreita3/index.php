<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------

const REITA_VER = 'v3.0.0';
const REITA_LOT = 'lot.20251206';

$lang = ($http_langs = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '') ? explode( ',', $http_langs )[0] : '';
$en = (stripos($lang,'ja') !== 0);

// PHPバージョンチェック
if (version_compare(PHP_VERSION, '7.3.0', '<')) {
	die($en ? "Error. PHP version 7.3.0 or higher is required for this program to work. <br>\n(Current PHP version:".PHP_VERSION.")" : "エラー。本プログラムの動作には PHPバージョン 7.3.0 以上が必要です。<br>\n(現在のPHPバージョン：".PHP_VERSION.")"
	);
}

// 必要なファイルの確認と読み込み

// config存在確認
if(!is_file(__DIR__.'/config.php')) {
	die(__DIR__.'/config.php'.($en ? ' does not exist.' : 'がありません。'));
}
require_once(__DIR__.'/config.php');
// 管理パスが初期値だと動かさない
if(ADMIN_PASS === 'admin_password_change_me') {
  die($en ? "Error. You must change the default admin password before using this program." : "エラー。本プログラムを使用する前に、管理者パスワードを初期値から変更する必要があります。");
}

// functions存在確認とバージョンチェック
if(!is_file(__DIR__.'/functions.php')) {
  die(__DIR__.'/functions.php'.($en ? ' does not exist.' : 'がありません。'));
}
require_once(__DIR__.'/functions.php');
if(!isset($functions_ver) || $functions_ver < 20251206) {
  die($en ? 'Please update functions.php to the latest version.' : 'functions.phpを最新版に更新してください。');
}

// その他ファイル確認
check_file(__DIR__.'/misskey_note.inc.php');
require_once(__DIR__.'/misskey_note.inc.php');
if(!isset($misskey_note_ver) || $misskey_note_ver < 20250718) {
  die($en ? 'Please update misskey_note.inc.php to the latest version.' : 'misskey_note.inc.phpを最新版に更新してください。');
}

check_file(__DIR__.'/save.inc.php');
require_once(__DIR__.'/save.inc.php');
if(!isset($save_inc_ver) || $save_inc_ver < 20250918) {
  die($en ? 'Please update save.inc.php to the latest version.' : 'save.inc.phpを最新版に更新してください。');
}

check_file(__DIR__.'/search.inc.php');
require_once(__DIR__.'/search.inc.php');
if(!isset($search_inc_ver) || $search_inc_ver < 20250906) {
	die($en ? 'Please update search.inc.php to the latest version.' : 'search.inc.phpを最新版に更新してください。');
}

check_file(__DIR__.'/sns_share.inc.php');
require_once(__DIR__.'/sns_share.inc.php');
if(!isset($sns_share_inc_ver) || $sns_share_inc_ver < 20251031) {
  die($en ? 'Please update search.inc.php to the latest version.' : 'sns_share.inc.phpを最新版に更新してください。');
}

check_file(__DIR__.'/thumbnail_gd.inc.php');
require_once(__DIR__.'/thumbnail_gd.inc.php');
if(!isset($thumbnail_gd_ver)||$thumbnail_gd_ver<20250707) {
  error($en ? 'Please update thumbnail_gd.inc.php to the latest version.' : 'thumbnail_gd.inc.phpを最新版に更新してください。');
}

check_file(__DIR__.'/noticemail.inc.php');
require_once(__DIR__.'/noticemail.inc.php');
if(!isset($noticemail_inc_ver) || $noticemail_inc_ver < 20250315) {
  error($en ? 'Please update noticemail.inc.php to the latest version.' : 'noticemail.inc.phpを最新版に更新してください。');
}

//--------------------------------------------------

