<?php
//0. SESSION開始！！
session_start();

//LOGINチェック → funcs.phpへ関数化しましょう！
include("funcs.php");
sschk();

//エラー表示 (全部これ)
ini_set("display_errors", 1);
$id = $_GET["id"];

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM kadai10 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$v="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_select.php">ユーザ一覧へ戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー更新</legend>
     <label>名前：<input type="text" name="name" value="<?=$v["name"]?>"></label><br>
     <label>Login ID：<input type="text" name="lid" value="<?=$v["lid"]?>"></label><br>
     <!-- <label>Login PW<input type="text" name="lpw"></label><br> -->
     <label>管理FLG：
     管理者<input type="radio" name="kanri_flg" value="1" <?= ($v["kanri_flg"] == 1) ? 'checked' : '' ?>>
     一般<input type="radio" name="kanri_flg" value="0" <?= ($v["kanri_flg"] == 0) ? 'checked' : '' ?>>
    </label>     <input type="submit" value="更新">
     <input type="hidden" name="id" value="<?=$v["id"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

