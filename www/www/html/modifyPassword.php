<?php
include "include/isConnected.php";
include_once "classes/DB.php";
if ($_POST['inputPassword1'] == $_POST['inputPassword2']) {
    $db = new DB();
    $result = $db->updatePassword($_SESSION['login_name'], $_POST['inputPassword1']);
    header("Location: messagerie.php");
}
else{
    header("Location: myProfile.php?error=true");
}