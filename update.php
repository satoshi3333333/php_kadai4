<!-- 更新のPHP -->
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

<?php
//1. POSTデータ取得
$q1 = $_POST["q1"];
$q2 = $_POST["q2"];
$q3_1 = $_POST["q3_1"];
$q3_2 = $_POST["q3_2"];
$q3_3 = $_POST["q3_3"];
$q3_4 = $_POST["q3_4"];
$q4 = $_POST["q4"];
$q5 = $_POST["q5"];
$q6 = $_POST["q6"];
$name = $_POST["name"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$source = $_POST["source"];
$frequency = $_POST["frequency"];
$id     = $_POST["id"];

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
sschk();
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE php_kadai2_table SET q1_manzokudo=:q1, q2_reason=:q2, q3_quality=:q3_1, q3_usability=:q3_2, q3_price=:q3_3, q3_support=:q3_4, q4_recommend=:q4, q5_q4reason=:q5, q6_review=:q6, name=:name, age=:age, seibetsu=:gender, kikkake=:source, hindo=:frequency WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':q1', $q1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':q2', $q2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':q3_1', $q3_1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':q3_2', $q3_2, PDO::PARAM_STR);
$stmt->bindValue(':q3_3', $q3_3, PDO::PARAM_STR);
$stmt->bindValue(':q3_4', $q3_4, PDO::PARAM_STR);
$stmt->bindValue(':q4', $q4, PDO::PARAM_STR);
$stmt->bindValue(':q5', $q5, PDO::PARAM_STR);
$stmt->bindValue(':q6', $q6, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':source', $source, PDO::PARAM_STR);
$stmt->bindValue(':frequency', $frequency, PDO::PARAM_STR);
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}









