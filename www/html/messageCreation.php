<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Vérification de la création d'un message
 */

include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "classes/DB.php";

if (!isset($_POST['destinataire']) ||
    !isset($_POST['sujet']) ||
    !isset($_POST['corps'])  ) {
    exit;
}

//TODO Sanizater ces entrées utilisateurs
$destinataire = $_POST['destinataire'];
$sujet = $_POST['sujet'];
$corps = $_POST['corps'];


$db = new DB();
date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');
$db->createMessage($date, $_POST['corps'], $_POST['sujet'], $_SESSION['login_name'], $_POST['destinataire']);
header("Location: messagerie.php");