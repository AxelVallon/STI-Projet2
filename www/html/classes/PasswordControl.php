<?php
class PasswordControl {
    public static function hashPassword($password, $rounds = 10000)
    {
        // Generate random salt
        $salt = substr(bin2hex(openssl_random_pseudo_bytes(16)),0,16);
        // $6$ specifies SHA512
        return crypt($password, sprintf('$6$rounds=%d$%s$', $rounds, $salt));
    }

    public static function verifyPassword($password, $hashPassword){
        return password_verify($password, $hashPassword);
    }

    public static function isValidPassword($password){
        return (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password) == 1);
    }
}