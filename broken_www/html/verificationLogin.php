<?php
include_once "classes/DB.php";
$db = new DB();
$result = $db->login($_POST['inputLogin'], $_POST['inputPassword']);
if ($result == true){
    $_SESSION['est_admin'] = $result['est_admin'];
    $_SESSION['login_name'] = $login;
    header("Location: messagerie.php");
}
else{
    header("Location: index.php?error=true");
}