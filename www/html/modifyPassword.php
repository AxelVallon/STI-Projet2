<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la modification d'un mot de passe
 */

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
    header("Location: myProfile.php?error=invalid_password_format");
    return;
}

if ($_POST['inputPassword1'] != $_POST['inputPassword2']) {
    header("Location: myProfile.php?error=different_password");
    return;
}

//TODO sanitazer le premier mot de passe
$mot_de_passe = $_POST['inputPassword1'];

$db = new DB();
$result = $db->updatePassword($_SESSION['login_name'], PasswordControl::hashPassword($mot_de_passe));
header("Location: messagerie.php");
