<?php
include_once "classes/DB.php";
$db = new DB();
$result = $db->login($_POST['inputLogin'], $_POST['inputPassword']);
if ($result == true){
    header("Location: messagerie.php");
}
else{
    header("Location: index.php?error=true");
}