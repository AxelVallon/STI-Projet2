<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "classes/DB.php";
$db = new DB();
date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');
$db->createMessage($date, $_POST['corps'], $_POST['sujet'], $_SESSION['login_name'], $_POST['destinataire']);
header("Location: messagerie.php");