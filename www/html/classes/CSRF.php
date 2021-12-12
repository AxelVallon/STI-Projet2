<?php
session_start();
class CSRF{
    static public function updateToken(){
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }
    static public function insertHiddenInput()
    {
        echo '<input type="hidden" name="token" value="' . $_SESSION['token'].  '">';
    }
    static public function verification($token_input)
    {
        if (!isset($token_input) || $token_input !== $_SESSION['token']) {
            // return 405 http status code
            die("You failed the CSRF test");
        }
    }

}