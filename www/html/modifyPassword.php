<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

if (!isset($_POST['inputPassword1']) || !isset($_POST['inputPassword2'])) {
    // Could not get the data that should have been sent.
    header("Location: myProfile.php?error=empty_field");
    return;
}

if (!PasswordControl::isValidPassword($_POST['inputPassword1'])){
    header("Location: myProfile.php?error=invalid_password");
    return;
}

if ($_POST['inputPassword1'] != $_POST['inputPassword2']) {
    header("Location: myProfile.php?error=different_password");
    return;
}

$db = new DB();
$result = $db->updatePassword($_SESSION['login_name'], PasswordControl::hashPassword($_POST['inputPassword1']));
header("Location: messagerie.php");
