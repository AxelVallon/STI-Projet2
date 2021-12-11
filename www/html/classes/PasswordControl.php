<?php
class PasswordControl {
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hashPassword){
        return password_verify($password, $hashPassword);
    }

    public static function isValidPassword($password){
        return (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password) == 1);
    }
}