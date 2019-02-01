<?php

session_start();
var_dump($_POST);
echo "ok";

$username = "";
if (!empty($_POST['postuser'])) {
  $_SESSION["username"] = $_POST['postuser'];
  header("Location: profil.php");
  exit;

}

if (isset($_POST['decuser'])) {
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    $_SESSION = array();
    session_destroy();
    echo "bonjour";
    header("Location: profil.php");
    exit;
}
 ?>
