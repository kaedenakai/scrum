<?php
//0. SESSION開始！！
session_start();

//LOGINチェック → funcs.phpへ関数化しましょう！
include("funcs.php");
sschk();

//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM kadai10 WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("user_select.php");
}

