<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Fourni de la sécurité pour l'authentification et les authorisations
 */

session_start();

// security
class AccessControl
{
    /**
     * Redirige l'utilisateur quand il n'est pas authentifié
     * @param $redirectPage
     */
    public static function authentificationVerification($redirectPage){
        if (!isset($_SESSION['login_name'])) {
            header('Location: ' . $redirectPage);
        }
    }

    /**
     * Redirige l'utilisateur quand il n'est pas authorisé d'accéder à une ressource
     * @param $redirectPage
     */
    public static function adminVerification($redirectPage){
        if (isset($_SESSION['login_name']) && $_SESSION['est_admin'] != '1'){
            header('Location: ' . $redirectPage);
        }
    }
}