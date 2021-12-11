<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la mise à jour d'un utilisateur
 */

include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("message.php?error=403");
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

$db = new DB();
$est_valide = isset($_POST['est_valide']) ? '1' : '0';
$est_admin = isset($_POST['est_admin']) ? '1' : '0';

if (!isset($_POST['login_name']) || !isset($_POST['mot_de_passe'])) {
    // Could not get the data that should have been sent.
    header("Location: listUser.php?error=empty_field");
    return;
}

if ($_POST['mot_de_passe'] != "" && !PasswordControl::isValidPassword($_POST['mot_de_passe'])){
    header("Location: listUser.php?error=invalid_password_format");
    return;
}

//TODO sanitazer
$login_name = $_POST['login_name'];
$mot_de_passe = $_POST['mot_de_passe'];

$db = new DB();
if (isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] != "") {
    $db->updateUser($login_name, PasswordControl::hashPassword($mot_de_passe), $est_valide, $est_admin);
}
else {
    $db->updateUserWithoutPassword($login_name, $est_valide, $est_admin);
}
header("Location: listUser.php");