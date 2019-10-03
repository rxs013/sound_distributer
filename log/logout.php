<?php
session_start();

if (isset($_SESSION["ID"])) {
  echo 'Logoutしました。';
} else {
  echo 'SessionがTimeoutしました。';
}
//セッション変数のクリア
$_SESSION = array();
//セッションクッキーも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//セッションクリア
@session_destroy();
echo "<div><a href='/sdist.php'>ログインはこちら。</a></div>";
echo "<div><a href='/index.html'>表向きのページはこちら。</a></div>";
?>