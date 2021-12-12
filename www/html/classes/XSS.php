<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Fourni de la sécurité contre les menace du type XSS
 */

// security
class XSS
{
    /**
     * Permet de préparer des données à montrer à l'utilisateur
     * @param $content Contenu pas fiable
     * @return string Contenu prêt à être affiché
     */
    public static function textSanitizer($content){
        return htmlspecialchars($content, ENT_QUOTES, "UTF-8");
    }
}