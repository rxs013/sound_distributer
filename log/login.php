<?php
require_once('config.php');

session_start();

//DB内でPOSTされたIDを検索
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('select * from users where id = ?');
  $stmt->execute([$_POST['id']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//idがDB内に存在しているか確認
if (!isset($row['id'])) {
  echo 'ID又はパスワードが間違っています。';
  return false;
}
//パスワード確認後sessionにIDを渡す
if (password_verify($_POST['password'], $row['password'])) {
    if($row['admin'] != 1){
        echo '管理者権限が付与されるまでお待ちください。';
        return false;
    }
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['ID'] = $row['id'];
      // リダイレクト先のURLへ転送する
header('Location: http://'.$_SERVER['HTTP_HOST'].'/console.php' , true, 301);

// すべての出力を終了
exit;
} else {
  echo 'ID又はパスワードが間違っています。';
  return false;
}
?>