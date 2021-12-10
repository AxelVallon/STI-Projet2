<?php
session_start();
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

$db = new DB();
$result = $db->login($_POST['inputLogin']);
//if the result is empty, we want to process password comparison to have approximately the same execution time
// to avoid timing attack
if (!isset($result)){
    $result['mot_de_passe'] = "randomHashInvalid";
}
if (PasswordControl::verifyPassword($_POST['inputPassword'], $result['mot_de_passe']) && isset($result['est_valide']) && $result['est_valide'] == 1) {
    $_SESSION['est_admin'] = $result['est_admin'];
    $_SESSION['login_name'] = $result['login_name'];
    header("Location: messagerie.php");
}
else{
    header("Location: index.php?error=true");
}