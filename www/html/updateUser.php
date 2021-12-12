<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la mise à jour d'un utilisateur
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

// security : verification of authentication and authorization
AccessControl::authentificationVerification("index.php?error=401");
AccessControl::adminVerification("message.php?error=403");
// security : verification du token envoyé depuis le formulaire associé
CSRF::verification($_POST['token']);

$db = new DB();
// récupération des checkbox
$est_valide = isset($_POST['est_valide']) ? '1' : '0';
$est_admin = isset($_POST['est_admin']) ? '1' : '0';

// security : il faut remplir le formulaire via le site, et ne pas oublier des champs...
if (!isset($_POST['login_name']) || !isset($_POST['mot_de_passe'])) {
    // Could not get the data that should have been sent.
    die("Merci d'utiliser l'interface web de ce site");
}

// Si aucun mot de passe saisi, il n'est pas modifié. Si modifié et invalide, on fait une redirection d'erreur
if ($_POST['mot_de_passe'] != "" && !PasswordControl::isValidPassword($_POST['mot_de_passe'])){
    header("Location: listUser.php?error=invalid_password_format");
    return;
}

$login_name = $_POST['login_name'];
$mot_de_passe = $_POST['mot_de_passe'];

$db = new DB();
// Mot de passe modifié
if (isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] != "") {
    $db->updateUser($login_name, PasswordControl::hashPassword($mot_de_passe), $est_valide, $est_admin);
}
else { // pas modifié, donc on conserve l'ancien
    $db->updateUserWithoutPassword($login_name, $est_valide, $est_admin);
}
header("Location: listUser.php");