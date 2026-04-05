# お絵かき掲示板PHPスクリプト noReita3

![php](https://img.shields.io/badge/php-7.4-green.svg)
![php](https://img.shields.io/badge/php-8.x-green.svg)

![Last commit](https://img.shields.io/github/last-commit/sakots/noReita3)
![version](https://img.shields.io/github/v/release/sakots/noReita3)
![Downloads](https://img.shields.io/github/downloads/sakots/noReita3/total)
![License](https://img.shields.io/github/license/sakots/noReita3)

- SQLiteを利用したスレッド式の画像掲示板です。
- PaintBBS NEO,tegaki.js,Litachix,Klecksが使えるお絵かき掲示板です。

---

**まだ実験段階です。実用しないでください。**

---

## 動作環境

- PHP7.4以上の環境が必要です。
  - PHP7.4,PHP8.2-8.5で動作確認しています。
  - PHP8.2-PHP8.5での使用を推奨します。

## noReita v2以前との互換

- データベースの形式が違いますが、移行スクリプトがあります。

## ダウンロードと設置

### ダウンロード

- [リリース](https://github.com/sakots/noReita3/releases/latest)からダウンロードできます。

### 設置方法

- 設置するサーバのPHPのバージョンが7.4以上になっている事を確認します。
- [リリース](https://github.com/sakots/noReita3/releases/latest)のページから圧縮ファイルをダウンロードします。
- `noReita`フォルダ内の`config.example.php`を複製して`config.php`に名前変更、管理者パスワードを他の人にはわからないパスワードに変更します。（元のままでは動かないようにしてあります）
- `noReita`フォルダをアップロードします。
- サーバ上の`noReita`ディレクトリにブラウザでアクセスすると設置が完了します。

## 同梱のパレットについて

`p_PCCS.txt`(PCCS:日本色研配色体系パレット)は、[色彩とイメージの情報サイト IROUE](https://tee-room.info/color/database.html) を参考に、
`p_munsellHVC.txt`(マンセルHV/Cパレット)は、[マンセル表色系とRGB値](http://k-ichikawa.blog.enjoy.jp/etc/HP/js/Munsell/MSL2RGB0.html) を参照して作成いたしました。

再配布等自由にしていただいて構いません。ただの文字列なので著作権の主張はしませんが、書くのにそれなりの苦労はしましたので、再配布の際はどこかに私の名前を書いていただければと思います。

## 同梱していないパレットについて

[こちらで「やこうさんパレット」が配布されています](https://github.com/satopian/potiboard_plugin)

使用する場合は、`config.php`内の`$pallets_dat`の列に、

```config.php
$pallets_dat = array(['標準','palette.txt'],['PCCS_HSL','p_PCCS.txt'],['マンセルHV/C','p_munsellHVC.txt'],['やこうさん','palette.dat']);
```

などと加えてください。

## 履歴

### [2026/04/05] v3.0.0

- エラーメッセージをすべて本体で記述した
- 投稿にUUIDを付加

### [2026/04/05]

- noReita2系から移植

### [2025/12/03]

- リポジトリ生やした
