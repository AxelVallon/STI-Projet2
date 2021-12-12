<?php

class XSS
{
    public static function textSanitizer($content){
        return htmlspecialchars($content, ENT_QUOTES, "UTF-8");
    }
}