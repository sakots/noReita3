<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------

const FUNCTIONS_VER = 20251206;

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

//パスワードを5回連続して間違えた時は拒絶
function check_password_input_error_count(): void {
  global $en;
  if(!CHECK_PASSWORD_INPUT_ERROR_COUNT) {
    return;
  }
  $file = __DIR__.'/template/errorlog/error.log';
  $user_ip = get_uip();
  check_dir(__DIR__.'/template/errorlog/');
  $arr_err = is_file($file) ? file($file) : [];
  if(count($arr_err) >= 5){
    error($en ? 'Rejected.' : '拒絶されました。');
  }
  if(!is_admin_pass(filter_input_data('POST','admin_pass'))) {

    $errorlog = $user_ip."\n";
    file_put_contents($file,$errorlog,FILE_APPEND);
    chmod($file,0600);
  } else {
    safe_unlink($file);
  }
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