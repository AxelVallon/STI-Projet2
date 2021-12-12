<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Affiche les détails d'un message
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
include_once "classes/XSS.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php";
include_once "classes/DB.php";
$db = new DB();
$message = $db->getMessage($_GET['id']);
CSRF::updateToken();
?>
<body>
<div class="container mt-3">
    <br><h2>Détail du message</h2><br>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Sujet</span>
        <input type="text" class="form-control" value="<?php echo XSS::textSanitizer($message['sujet'])?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Date</span>
        <input type="text" class="form-control" value="<?php echo XSS::textSanitizer($message['date_reception'])?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Emetteur du message</span>
        <input type="text" class="form-control" value="<?php echo XSS::textSanitizer($message['login_name_expediteur'])?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Contenu du message</span>
        <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo XSS::textSanitizer($message['corps'])?></textarea>
    </div>
    <a class="btn btn-success" href="answerMessage.php?login=<?php echo XSS::textSanitizer($message['login_name_expediteur'])
        . '&sujet=' . XSS::textSanitizer($message['sujet']) ?>" role="button">Répondre</a>
    <form method="post" action="messagerie.php?supprID=<?php echo XSS::textSanitizer($message['id'])?>">
        <?php CSRF::insertHiddenInput() ?>
        <button class="btn btn-warning" type="submit" href= role="button">Supprimer</button>
    </form>
</div>
</body>
<?php

