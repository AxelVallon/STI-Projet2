<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Script pour effacer les sessions.
 */

session_start();
session_destroy();
header("Location: index.php");
