<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Méthode utilisée pour sécuriser l'authentification par mot de passe
 */

// security
class PasswordControl {
    /**
     * Return hash password with Bcrypt algorithm
     * @param $password
     * @return false|string|null
     */
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Permet de vérifier un mot de passe avec son hash
     * @param $password mot de passe en clair
     * @param $hashPassword mot de pas haché
     * @return bool Mot de passe identique
     */
    public static function verifyPassword($password, $hashPassword){
        return password_verify($password, $hashPassword);
    }

    /**
     * ReGex pour vérifier la validité d'un mot de passe
     * Doit avoir un minimum de 8 charactère
     * Doit avoir au moins un nombre
     * Doit avoir au moins une majuscule
     * Doit avoir au moins une minuscule
     * Doit avoir au moins un charactère spécial (#?!@$%^&*-)
     * @param $password mot de passe à vérifier
     * @return bool Le mot de passe est valide
     */
    public static function isValidPassword($password){
        return (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password) == 1);
    }
}