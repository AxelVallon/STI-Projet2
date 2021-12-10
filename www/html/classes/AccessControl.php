<?php
session_start();
class AccessControl
{
    public static function connectionVerification($redirectPage){
        if (!isset($_SESSION['login_name'])) {
            header('Location: ' . $redirectPage);
        }
    }

    public static function adminVerification($redirectPage){
        if (isset($_SESSION['login_name']) && $_SESSION['est_admin'] != '1'){
            header('Location: ' . $redirectPage);
        }
    }
}