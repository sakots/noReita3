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
if(ADMIN_PASS === 'admin_password_change_me') {
  die($en ? "Error. You must change the default admin password before using this program." : "エラー。本プログラムを使用する前に、管理パスワードを初期値から変更する必要があります。");
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
  error($en ? 'Please update noticemail.inc.php to the latest version.' : 'noticemail.inc.phpを最新版に更新してください。');
}

//--------------------------------------------------

// BladeOne v4.19.1
include(__DIR__ . '/BladeOne/lib/BladeOne.php');
use eftec\bladeone\BladeOne;

$views = __DIR__ . '/theme/' . THEME_DIR; // テンプレートフォルダ
$cache = __DIR__ . '/cache'; // キャッシュフォルダ

$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
// MODE_DEBUGだと開発モード MODE_AUTOが速い。
$blade->pipeEnable = true; // パイプのフィルターを使えるようにする
// 出力配列
$dat = [];

if(!MAX_LOG || !is_numeric(MAX_LOG) || MAX_LOG < 1) {
	error($en ? 'The maximum number of threads is not set or is an invalid value.' : '最大スレッド数が設定されていないか、不正な値です。');
}

// 共通変数
$mode = (string)filter_input_data('POST','mode');
$mode = $mode ? $mode :(string)filter_input_data('GET','mode');
$resno = (int)filter_input_data('GET','resno',FILTER_VALIDATE_INT);
$https_only = (bool)($_SERVER['HTTPS'] ?? '');
// user-codeの発行
$user_code = delete_tab(filter_input_data('COOKIE', 'user_code')); //user-codeを取得

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

$dat['app_dir'] = APP_DIR;

$dat['pallets_dat'] = PALETTES_DAT;

$dat['hide_id'] = HIDE_USER_ID;

$dat['use_name'] = NAME_INPUT_REQUIRED;
$dat['use_com'] = COMMENT_REQUIRED;
$dat['use_sub'] = SUBJECT_INPUT_REQUIRED;

$dat['descriptions'] = BOARD_DESCRIPTIONS;

$dat['hide_drawing_time'] = USE_HIDE_DRAWING_TIME;
$dat['hide_all_drawing_time'] = HIDE_ALL_DRAWING_TIME;

$dat['board_name'] = BOARD_NAME;

// データベース接続PDO
define('DB_PDO', 'sqlite:' . DATABASE_NAME . '.db');

$mode = (string)filter_input_data('POST','mode');
$mode = $mode ?: (string)filter_input_data('GET','mode');

$resno = (int)filter_input_data('GET','resno',FILTER_VALIDATE_INT);
$https_only = (bool)($_SERVER['HTTPS'] ?? '');

//user-codeの発行
$usercode = delete_tab(filter_input_data('COOKIE', 'usercode')); //user-codeを取得

$usercode = $usercode ?: $session_usercode;
if(!$usercode){ //user-codeがなければ発行
  $userip = get_uip();
  $usercode = hash('sha256', $userip.random_bytes(16));
}
setcookie("usercode", $usercode, time()+(86400*365),"","",$https_only,true); //1年間
$_SESSION['usercode'] = $usercode;

//$x_frame_options_deny = $x_frame_options_deny ?? true;
//if($x_frame_options_deny){
//	header("Content-Security-Policy: frame-ancestors 'none';");
//}
//ダークモード
if(!isset($_COOKIE["set_darkmode"])&&$darkmode_by_default){
  setcookie("set_darkmode","1",time()+(60*60*24*180),"","",$https_only,true);
}

// 初期設定
init();

// 一時ファイル削除
del_temp();

// mode
switch($mode){
  case 'regist':
  if($deny_all_posts){
    return view();
  }
  return post();
  case 'paint':
  return paint();
  case 'paint_com':
  return paint_com();
  case 'pch_view':
  return pch_view();
  case 'to_continue':
  return to_continue();
  case 'continue_paint':
  $type = (string)filter_input_data('POST', 'type');
  if($type === 'rep'||$password_require_to_continue){
    check_continue_pass();
  }
  return paint();
  case 'set_app_select_enabled_session':
  return set_app_select_enabled_session();
  case 'pic_rep':
  return img_replace();
  case 'before_del':
  return confirmation_before_deletion();
  case 'edit_form':
  return edit_form();
  case 'edit':
  return edit();
  case 'del':
  return del();
  case 'user_del':
  return user_del_mode();
  case 'admin_in':
  return admin_in();
  case 'admin_del':
  return admin_del();
  case 'admin_post':
  return admin_post();
  case 'aikotoba':
  return aikotoba();
  case 'age_check':
  return age_check();
  case 'view_nsfw':
  return view_nsfw();
  case 'set_nsfw_show_hide':
  return set_nsfw_show_hide();
  case 'set_darkmode':
  return set_darkmode();
  case 'logout_admin':
  return logout_admin();
  case 'logout':
  return logout();
  case 'set_share_server':
  return sns_share::set_share_server();
  case 'post_share_server':
  return sns_share::post_share_server();
  case 'before_misskey_note':
  return misskey_note::before_misskey_note();
  case 'misskey_note_edit_form':
  return misskey_note::misskey_note_edit_form();
  case 'create_misskey_note_sessiondata':
  return misskey_note::create_misskey_note_sessiondata();
  case 'create_misskey_authrequesturl':
  return misskey_note::create_misskey_authrequesturl();
  case 'misskey_success':
  return misskey_note::misskey_success();
  case 'saveimage':
  return saveimage();
  case 'search':
  return processsearch::search();
  case 'catalog':
  return catalog();
  case 'download':
  return download_app_dat();
  case '':
  if($resno){
    return res();
  }
  return view();
  default:
  return view();
}

// 投稿
function post(): void {

}

// 通常表示
function view(): void {
  global $dat;
  
  set_page_context_to_session();
}