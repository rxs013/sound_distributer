<?php
// データベース接続
require_once('frconfig.php');
//データベースへ接続、テーブルがない場合は作成
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
// データ取得用SQL
// 値はバインドさせる
$sql = "SELECT * FROM disctitle";
// SQLをセット
$stmt = $pdo->prepare($sql);
// SQLを実行
$stmt->execute();

// あらかじめ配列$resultを作成する
// 受け取ったデータを配列に代入する
// 最終的にhtmlへ渡される
$result = array();

// fetchメソッドでSQLの結果を取得
// 定数をPDO::FETCH_ASSOC:に指定すると連想配列で結果を取得できる
// 取得したデータを$resultへ代入する
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $result[] = array(
        'id'    => $row['id'],
        'name'  => $row['name'],
    );
}

// ヘッダーを指定することによりjsonの動作を安定させる
header('Content-type: application/json');
// htmlへ渡す配列$resultをjsonに変換する
echo json_encode($result);
?>