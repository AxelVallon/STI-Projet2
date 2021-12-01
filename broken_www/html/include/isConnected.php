<?php
session_start();
if (!isset($_SESSION['login_name'])){
    header("Location: index.php");
}
