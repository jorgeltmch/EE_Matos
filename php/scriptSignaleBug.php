<?php

if (!filter_has_var(INPUT_POST,'btnBug')) {
header('Location: ./contact.php');
exit();
}
$desBug = filter_input(INPUT_POST, 'desBug', FILTER_SANITIZE_STRING);
require_once '../classe/database.php';
require_once 'fonction.php';
require_once '../PHPMailer/examples/gmail.php';

$donneUser = getUserById($_SESSION["uID"]);
$_SESSION["bug"] = true;
$_SESSION["desBug"] = $desBug;
getMail($donneUser['email'], $donneUser['idUser']);



echo '<script type="text/javascript">window.location = "./contact.php"</script>';
echo realpath('.'); 
exit();