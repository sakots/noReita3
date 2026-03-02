<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------

const FUNCTIONS_VER = 20251206;

function error($str,$history_back = true): void {

  global $en;

  $async_flag = (bool)filter_input_data('POST','async_flag',FILTER_VALIDATE_BOOLEAN);
  $http_x_requested_with = (bool)(isset($_SERVER['HTTP_X_REQUESTED_WITH']));
  if($http_x_requested_with || $async_flag) {
    header('Content-type: text/plain');
    die(h("error\n{$str}"));
  }

  // あとで出力を修正
  $template = 'error.html';
  include __DIR__.'/'.$skindir.$template;
  exit();
}

//csrfトークンを作成
function get_csrf_token(): string {
  session_sta();
  $token = hash('sha256', session_id(), false);
  $_SESSION['token'] = $token;
  return $token;
}

//csrfトークンをチェック
function check_csrf_token(): void {
  global $en;

  if(($_SERVER["REQUEST_METHOD"]) !== "POST") {
    error($en ? 'This operation has failed.' : '失敗しました。');
  }
  check_same_origin();
  session_sta();
  $token = (string)filter_input_data('POST','token');
  $session_token = isset($_SESSION['token']) ? (string)$_SESSION['token'] : '';

  if(!$token || !$session_token || !hash_equals($session_token,$token)) { //タイミング攻撃対策としてhash_equals()を使用
    error($en ? "CSRF token mismatch.\nPlease reload." : "CSRFトークンが一致しません。\nリロードしてください。");
  }
}

//session開始
function session_sta(): void {
  global $session_name;

  $session_name = $session_name ?? 'session_petit';
  $https_only = (bool)($_SERVER['HTTPS'] ?? '');

  if(!isset($_SESSION)) {
    ini_set('session.use_strict_mode', 1);
    session_set_cookie_params(0,"","",$https_only,true);
    session_name($session_name);
    session_start();
    header('Expires:');
    header('Cache-Control:');
    header('Pragma:');
  }
}

function check_same_origin(): void {
  global $en,$user_code;

  session_sta();
  $c_user_code = delete_tab(filter_input_data('COOKIE', 'user_code')); //user-codeを取得
	$session_user_code = isset($_SESSION['user_code']) ? delete_tab($_SESSION['user_code']) : "";
  if(!$c_user_code) {
    error($en ? 'Cookie check failed.' : 'Cookieが確認できません。');
  }
  if(!$user_code || ($user_code !== $c_user_code) && ($user_code !== $session_user_code)) {
    error($en ? "User code mismatch." : "ユーザーコードが一致しません。");
  }

  $sec_fetch_site = $_SERVER['HTTP_SEC_FETCH_SITE'] ?? '';
  $same_origin = ($sec_fetch_site === 'same-origin');

  if(!isset($_SERVER['HTTP_ORIGIN']) || !isset($_SERVER['HTTP_HOST'])) {
    error($en ? 'Your browser is not supported. ' : 'お使いのブラウザはサポートされていません。');
  }
  if(!$same_origin && (parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST) !== $_SERVER['HTTP_HOST'])) {
    error($en ? "The post has been rejected." : '拒絶されました。');
  }
}

// ini_getで取得したサイズ文字列をMBに変換
function ini_get_size_mb(string $key): float {
  if (!function_exists('ini_get')) return 0;

  $val = ini_get($key);
  $unit = strtoupper(substr($val, -1));
  $num = (float)$val;

  switch ($unit) { //単位の変換
    case 'G':
    return ($num * 1024);	// GB → MB
    case 'M':
    return $num;						// MB → MB
    case 'K':
    return ($num / 1024);	// KB → MB
    case 'B':
    return ($num / 1024 / 1024);	// バイト → MB
    default:
    return ((float)$val / 1024 / 1024); // 単位なし → バイトとして処理
  }
}

//投稿可能な最大ファイルサイズを取得 単位MB
function get_upload_max_filesize(): float {
  $upload_max = ini_get_size_mb('upload_max_filesize');
  $post_max = ini_get_size_mb('post_max_size');
  return min($upload_max, $post_max);
}

//使用するペイントアプリの配列化
function app_to_use(): array {
  $arr_apps = [];
  if(USE_PAINTBBS_NEO) {
    $arr_apps[] = 'neo';
  }
  if(USE_LITACHIX) {
    $arr_apps[] = 'chi';
  }
  if(USE_KLECKS) {
    $arr_apps[] = 'klecks';
  }
  if(USE_TEGAKI) {
    $arr_apps[] = 'tegaki';
  }
  if(USE_AXNOS_PAINT) {
    $arr_apps[] = 'axnos';
  }
  return $arr_apps;
}

//filter_input のラッパー関数
function filter_input_data(string $input, string $key, int $filter=0) {
  // $_GETまたは$_POSTからデータを取得
  $value = null;
  if ($input === 'GET') {
    $value = $_GET[$key] ?? null;
  } elseif ($input === 'POST') {
    $value = $_POST[$key] ?? null;
  } elseif ($input === 'COOKIE') {
    $value = $_COOKIE[$key] ?? null;
  }

  // データが存在しない場合はnullを返す
  if ($value === null) {
    return null;
  }

  // フィルタリング処理
  switch ($filter) {
    case FILTER_VALIDATE_BOOLEAN:
    return  filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    case FILTER_VALIDATE_INT:
    return filter_var($value, FILTER_VALIDATE_INT);
    case FILTER_VALIDATE_URL:
    return filter_var($value, FILTER_VALIDATE_URL);
    default:
    return $value;  // 他のフィルタはそのまま返す
  }
}

/* テンポラリ内のゴミ除去 */
function del_temp(): void {
	$handle = opendir("./temp/");
	while ($file = readdir($handle)) {
		if (!is_dir($file)) {
			$lapse = time() - filemtime("./temp/" . $file);
			if ($lapse > (14 * 24 * 3600)) {
				safe_unlink("./temp/" . $file);
			}
			//pchアップロードペイントファイル削除
			if (preg_match("/\A(pchup-.*-tmp\.s?pch)\z/i", $file)) {
				$lapse = time() - filemtime("./temp/" . $file);
				if ($lapse > (300)) { //5分
					safe_unlink("./temp/" . $file);
				}
			}
		}
	}
	closedir($handle);
}

//タブ除去 t
function delete_tab($str): string {
  if(zero_check($str)){
    return '0';
  }
  if(!$str){
    return '';
  }
  return str_replace("\t","",(string)$str);
}

//タグ除去 s
function delete_tag($str): string {
  if(zero_check($str)){
    return '0';
  }
  if(!$str){
    return '';
  }
  return strip_tags((string)$str);
}

//エスケープ h
function escape_char($str) :string{
  if(zero_check($str)){
    return '0';
  }
  if(!$str){
    return '';
  }
  return htmlspecialchars($str,ENT_QUOTES,"utf-8",false);
}
// 0 または "0" かどうか
function zero_check($str): bool {
  return($str === 0 || $str === '0');
}

//-------------------------------------------------

function init(): void {
  check_dir(__DIR__."/src");
	check_dir(__DIR__."/temp");
	check_dir(__DIR__."/thumbnail");
	check_dir(__DIR__."/log");
	check_dir(__DIR__."/webp");
	check_dir(__DIR__."/cache");
}

//-------------------------------------------------

// データベース

// SQLiteデータベース初期化
function init_sqlite_db(): void {
  try {
  $db = new PDO('sqlite:' . DATABASE_NAME . '.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->exec("CREATE TABLE IF NOT EXISTS posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT, --通しID
    no INTEGER NOT NULL, --投稿番号
    created TIMESTAMP, --投稿日時
    modified TIMESTAMP, --更新日時
    thread VARCHAR(1), --スレッドの先頭か 1or0
    sub TEXT, --タイトル
    name TEXT, --名前
    verified VARCHAR(1), --認証ユーザーか 1or0
    com TEXT, --コメント
    url TEXT, --URL
    img_file TEXT, --画像ファイル名
    img_w TEXT, --画像の幅
    img_h TEXT, --画像の高さ
    thumbnail TEXT, --サムネイルファイル名
    paint_time TEXT, --お絵かき時間
    img_hash TEXT, --画像のハッシュ値
    tool TEXT, --使用したお絵かきツール
    pch_file TEXT, --動画ファイル名
    pch_ext TEXT, --動画ファイルの拡張子
    time TEXT NOT NULL, --絵の投稿にかかった時間
    first_posted_time TEXT NOT NULL, --最初の投稿の時間
    host TEXT, --ホスト名
    user_id TEXT, --ユーザーID
    hash TEXT, --パスワードのハッシュ値
    parent TEXT, --親投稿のno
    age INT, --age/sage記憶
    hidden VARCHAR(1), --表示/非表示（管理者削除）
    sodane INTEGER DEFAULT 0, --そうだね
    nsfw VARCHAR(1), -- NSFWフラグ 1or0
    threshold VARCHAR(1) --そろそろ消えるマーク 1or0
  )");
  } catch (PDOException $e) {
    error('Database initialization failed: ' . $e->getMessage());
  }
}

// SQLiteデータベース接続
function get_db(): PDO {
	try {
		$db = new PDO('sqlite:' . DATABASE_NAME . '.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	} catch (PDOException $e) {
		error('Database connection failed: ' . $e->getMessage());
		exit; // error()でexitするのでここは到達しないが、型チェックのため
	}
}
