<!-- ログイン情報を照会するためのファイル -->

<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();
// データベース接続エラーチェック
if (!$pdo) {
    die('データベースに接続できません: ' . mysqli_connect_error());
}


//2. データ登録SQL作成、ハッシュ化して照会
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM kadai10 WHERE lid=:lid"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()


//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  //管理フラグと名前とセッションIDを渡す   
  $_SESSION["chk_ssid"]  = session_id(); //セッションに各情報を記録する
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  //Login成功時（select.phpへ）
  redirect("index.php");

}else{
  //Login失敗時(login.phpへ)
  redirect("login.php");

}

exit();


