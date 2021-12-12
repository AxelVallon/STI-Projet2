<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la création d'un utilisateur
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

// if no set, not admin nor valid account
$est_valide = isset($_POST['est_valide']) ? '1' : '0';
$est_admin = isset($_POST['est_admin']) ? '1' : '0';

// security : we verify that the parameter have been sent
if (!isset($_POST['login_name']) || !isset($_POST['mot_de_passe'])) {
    // Could not get the data that should have been sent.
    die("Merci d'utiliser l'interface web de ce site");
}

$mot_de_passe = $_POST['mot_de_passe'];
$login_name = $_POST['login_name'];

if (!PasswordControl::isValidPassword($mot_de_passe)){
    header("Location: createUserForm.php?error=invalid_password_format");
    return;
}

$db = new DB();

// on ne pas pas créer deux fois le même utilisateur
if (is_array($db->fetchOneMember($login_name))){
    header("Location: createUserForm.php?error=user_already_exist");
    return;
}

// hash du mot de passe
$hashedPasswordSHA512 = PasswordControl::hashPassword($mot_de_passe);

// création du compte
$db->createUser($login_name, $hashedPasswordSHA512, $est_valide, $est_admin);
header("Location: listUser.php");