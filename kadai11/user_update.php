<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//0. SESSION開始！！
session_start();

//LOGINチェック → funcs.phpへ関数化しましょう！
include("funcs.php");
sschk();

//1. POSTデータ取得
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST["lid"];
// $lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$id    = $_POST["id"];

//2. DB接続します phpのドキュメントに乗ってる書き方そのまま
$pdo = db_conn();


//３．データ登録SQL作成
//データの受け渡しはphp以外にもセキュリティ上の約束がある
$spl = "UPDATE kadai10 SET name=:name, lid=:lid, kanri_flg=:kanri_flg WHERE id=:id";
$stmt = $pdo->prepare($spl); //pdoの中のprepareにsqlを入れる
//bindvalueはインジェクションを防ぐ変数、バインド変数に無効化したものを格納してsqlに渡してくれる
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．select.phpへリダイレクト
  redirect("user_select.php");

}
?>
