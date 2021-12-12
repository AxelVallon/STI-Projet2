<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Fourni de la sécurité contre les menace du type CSRF
 */

session_start();

// security
class CSRF{
    /**
     * Update the session token for CSRF protection
     */
    static public function updateToken(){
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    /**
     * Insert the session token in an hidden html input
     */
    static public function insertHiddenInput()
    {
        echo '<input type="hidden" name="token" value="' . $_SESSION['token'].  '">';
    }

    /**
     * Verification of token sent by POST method
     * @param $token_input input received during user input verification
     */
    static public function verification($token_input)
    {
        // le token doit exister et doit être équivalent à celui dans la session
        if (!isset($token_input) || $token_input !== $_SESSION['token']) {
            // return 405 http status code
            die("You failed the CSRF test");
        }
    }

}