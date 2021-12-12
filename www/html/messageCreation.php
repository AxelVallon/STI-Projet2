<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la création d'un message
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
AccessControl::connectionVerification("index.php?error=401");
CSRF::verification($_POST['token']);
include_once "classes/DB.php";


if (!isset($_POST['destinataire']) ||
    !isset($_POST['sujet']) ||
    !isset($_POST['corps'])  ) {
    die();
}

$destinataire = $_POST['destinataire'];
$sujet = $_POST['sujet'];
$corps = $_POST['corps'];

$db = new DB();

if (!is_array($db->fetchOneMember($destinataire))){
    header("Location: sendMessage.php?error=user_dont_exist");
    return;
}

date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');
$db->createMessage($date, $_POST['corps'], $_POST['sujet'], $_SESSION['login_name'], $_POST['destinataire']);
header("Location: messagerie.php");