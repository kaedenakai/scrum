<?php
//0. SESSION開始！！
session_start();

//LOGINチェック → funcs.phpへ関数化しましょう！
include("funcs.php");
sschk();

//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//2. DB接続します phpのドキュメントに乗ってる書き方そのまま
$pdo = db_conn();


//３．データ登録SQL作成
//データの受け渡しはphp以外にもセキュリティ上の約束がある
$spl = "INSERT INTO kadai08(name,url,memo,indate)VALUE(:name, :url, :memo, sysdate())";
$stmt = $pdo->prepare($spl); //pdoの中のprepareにsqlを入れる
//bindvalueはインジェクションを防ぐ変数、バインド変数に無効化したものを格納してsqlに渡してくれる
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  redirect("index.php");

}
?>
