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
// 第2パスが初期値だと動かさない
if(SECOND_PASS === 'admin_password_change_me') {
  die($en ? "Error. You must change the default admin password before using this program." : "エラー。本プログラムを使用する前に、第2パスワードを初期値から変更する必要があります。");
}

// functions存在確認とバージョンチェック
if(!is_file(__DIR__.'/functions.php')) {
  die(__DIR__.'/functions.php'.($en ? ' does not exist.' : 'がありません。'));
}
require_once(__DIR__.'/functions.php');
if(FUNCTIONS_VER === NULL || FUNCTIONS_VER < 20251206) {
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
if(SAVE_INC_VER === NULL || SAVE_INC_VER < 20251206) {
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
  error($en ? 'Please update notice_mail.inc.php to the latest version.' : 'notice_mail.inc.phpを最新版に更新してください。');
}

//--------------------------------------------------

//テンプレート
$theme_dir = 'themes/'.THEME_DIR;

if(!MAX_LOGS || !is_numeric(MAX_LOGS) || MAX_LOGS < 1) {
	error($en ? 'The maximum number of threads is not set or is an invalid value.' : '最大スレッド数が設定されていないか、不正な値です。');
}

//出力配列
$out = [];

//共通変数
$mode = (string)filter_input_data('POST','mode');
$mode = $mode ? $mode :(string)filter_input_data('GET','mode');
$resno = (int)filter_input_data('GET','resno',FILTER_VALIDATE_INT);
$https_only = (bool)($_SERVER['HTTPS'] ?? '');
//user-codeの発行
$user_code = t(filter_input_data('COOKIE', 'user_code')); //user-codeを取得

$dat['ver'] = REITA_VER;
$dat['lot'] = REITA_LOT;
$dat['board_name'] = BOARD_NAME;
$dat['home_url'] = HOME_URL;
$dat['p_def_w'] = DEFAULT_CANVAS_WIDTH;
$dat['p_def_h'] = DEFAULT_CANVAS_HEIGHT;
$dat['p_max_w'] = MAX_CANVAS_WIDTH;
$dat['p_max_h'] = MAX_CANVAS_HEIGHT;

$dat['use_neo'] = USE_PAINTBBS_NEO;
$dat['use_litachix'] = USE_LITACHIX;
$dat['use_klecks'] = USE_KLECKS;
$dat['use_tegaki'] = USE_TEGAKI;
$dat['use_axnos'] = USE_AXNOS_PAINT;

$dat['pallets_dat'] = PALETTES_DAT;

$dat['hide_id'] = HIDE_USER_ID;

$dat['use_name'] = NAME_INPUT_REQUIRED;
$dat['use_com'] = COMMENT_REQUIRED;
$dat['use_sub'] = SUBJECT_INPUT_REQUIRED;

$dat['descriptions'] = BOARD_DESCRIPTIONS;

$dat['hide_drawing_time'] = USE_HIDE_DRAWING_TIME;
$dat['hide_all_drawing_time'] = HIDE_ALL_DRAWING_TIME;

