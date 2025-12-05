<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」設定ファイル
//  by sakots https://oekakibbs.moe/
//--------------------------------------------------

const FUNCTIONS_VER = 20251206;

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