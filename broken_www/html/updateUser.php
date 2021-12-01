<?php
include "include/isConnected.php";
include_once "classes/DB.php";
if ($_SESSION['est_admin'] != '1'){
    header("Location: messagerie.php");
}
$db = new DB();
$est_valide = isset($_POST['est_valide']) ? '1' : '0';
$est_admin = isset($_POST['est_admin']) ? '1' : '0';
$db->updateUser($_POST['old_login_name'], $_POST['login_name'], $_POST['mot_de_passe'], $est_valide, $est_admin);
header("Location: listUser.php");