<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la création d'un utilisateur
 */

include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("message.php?error=403");
include_once "classes/DB.php";
include_once "classes/PasswordControl.php";

// if no set, not admin nor valid account
$est_valide = isset($_POST['est_valide']) ? '1' : '0';
$est_admin = isset($_POST['est_admin']) ? '1' : '0';

// we verify the field contents
if (!isset($_POST['login_name']) || !isset($_POST['mot_de_passe'])) {
    // Could not get the data that should have been sent.
    header("Location: createUserForm.php?error=empty_field");
    return;
}

//TODO verify $_POST['mot_de_passe'] && $_POST['login_name'] for sanitizer
$mot_de_passe = $_POST['mot_de_passe'];
$login_name = $_POST['login_name'];

/*
Password
Must be a minimum of 8 characters
Must contain at least 1 number
Must contain at least one uppercase character
Must contain at least one lowercase character
Must contain at least one special character (#?!@$%^&*-)
*/
if (!PasswordControl::isValidPassword($mot_de_passe)){
    header("Location: createUserForm.php?error=invalid_password_format");
    return;
}

$db = new DB();
$hashedPasswordSHA512 = PasswordControl::hashPassword($mot_de_passe);

$db->createUser($login_name, $hashedPasswordSHA512, $est_valide, $est_admin);
header("Location: listUser.php");