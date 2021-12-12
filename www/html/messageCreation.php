<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la création d'un message
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
include_once "classes/DB.php";

// security : verification of authentication and authorization
AccessControl::authentificationVerification("index.php?error=401");
// security : verification du token envoyé depuis le formulaire associé
CSRF::verification($_POST['token']);

if (!isset($_POST['destinataire']) ||
    !isset($_POST['sujet']) ||
    !isset($_POST['corps'])  ) {
    die("Merci d'utiliser l'interface web de ce site");
}

$destinataire = $_POST['destinataire'];
$sujet = $_POST['sujet'];
$corps = $_POST['corps'];

$db = new DB();

// ne peut pas envoyer un message à un utilisateur qui n'existe pas
if (!is_array($db->fetchOneMember($destinataire))){
    header("Location: sendMessage.php?error=user_dont_exist");
    return;
}

date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');
$db->createMessage($date, $_POST['corps'], $_POST['sujet'], $_SESSION['login_name'], $_POST['destinataire']);
header("Location: messagerie.php");