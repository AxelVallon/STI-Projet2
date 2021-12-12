<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la modification d'un mot de passe
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

// security : verification of authentication and authorization
AccessControl::authentificationVerification("index.php?error=401");
// security : verification du token envoyé depuis le formulaire associé
CSRF::verification($_POST['token']);

// security : les inputs doivent être saisis
if (!isset($_POST['inputPassword1']) || !isset($_POST['inputPassword2'])) {
    die("Merci d'utiliser l'interface web de ce site");
}

// security : le mot de passe doit être valide (Regex)
if (!PasswordControl::isValidPassword($_POST['inputPassword1'])){
    header("Location: myProfile.php?error=invalid_password_format");
    return;
}

// les mots de passes doivent être les même
if ($_POST['inputPassword1'] != $_POST['inputPassword2']) {
    header("Location: myProfile.php?error=different_password");
    return;
}

$mot_de_passe = $_POST['inputPassword1'];

$db = new DB();
$db->updatePassword($_SESSION['login_name'], PasswordControl::hashPassword($mot_de_passe));
header("Location: messagerie.php");
