<?php
//--------------------------------------------------
//  おえかきけいじばん「noReita3」のデータベース移行php
//  by sakots & OekakiBBS reDev.Team  https://oekakibbs.moe/
//--------------------------------------------------

// noreita_db2_to_3.php (c)sakots 2026 lot.260405.0
// The MIT License

// 使い方
// noReita3のindex.phpと同じディレクトリにアップロードして
// ブラウザでこのファイルを開くと、noReita3のデータベースが移行されます。
// 例）
// https://example.com/bbs/noreita_db2_to_3.php
// これを開くと、noReita3のデータベースが移行されます。
// 移行が完了したら、セキュリティのためにこのファイルは削除してください。

include(__DIR__.'/config.php'); // config.phpの設定を読み込む

// データベース接続PDO
const DB_PDO = 'sqlite:'.DB_NAME.'.db';

try {
  // db接続
  $db = new PDO(DB_PDO);
  // データベースがnoreita1,2のものかチェック
  // tlogテーブルが存在するかチェック
  $result = $db->query("SELECT ext01 FROM sqlite_master WHERE type='table' AND name='tlog'");
  if ($result->fetch() === false) {
    echo "このデータベースはnoReita1,2のものではないようです。tlogテーブルが見つかりませんでした。";
    exit;
  }
  // tlogテーブルをboard_logテーブルに移行する
  $sql = "INSERT INTO board_log (tid, created, modified, thread, parent, comid, tree, a_name, mail, sub, com, a_url, host, sodane, id, pwd, psec, utime, picfile, pchfile, img_w, img_h, age, invz, tool, admins, shd, nsfw, thumbnail, uuid, ext04) SELECT tid, created, modified, thread, parent, comid, tree, a_name, mail, sub, com, a_url, host, exid, id, pwd, psec, utime, picfile, pchfile, img_w, img_h, age, invz, tool, admins, shd, ext01, ext02, ext03, ext04 FROM tlog";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  // tlogテーブルを削除する
  $sql = "DROP TABLE tlog";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  echo "データベースの移行が完了しました。";
} catch (PDOException $e) {
  echo "DB接続エラー:" .$e->getMessage();
}