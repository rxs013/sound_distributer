<?php
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }
session_start();
if (!isset($_SESSION['ID'])) {
    header('Location: http://'.$_SERVER['HTTP_HOST'] , true, 301);
    exit();
}
  echo 'ようこそ' .  h($_SESSION['ID']) . "さん<br>";
  echo "<a href='/log/logout.php'>ログアウトはこちら。</a><br>";

?>

<!DOCTYPE html>
<html lang="ja">
<section id='upload'>
    <div>
    <form  action="/filem/upload.php" method="post">
    New disc<br>
    discID: <input type ="text" name = "id" /><br>
    title : <input type ="text" name ="title"/><br>
    <button type ="submit">うｐ</button>
</form>
</div>
</section>
