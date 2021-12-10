<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php";
include_once "classes/DB.php";
$db = new DB();
$message = $db->getMessage($_GET['id']);
?>
<body>
<div class="container mt-3">
    <br><h2>Détail du message</h2><br>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Sujet</span>
        <input type="text" class="form-control" value="<?php echo $message['sujet']?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Date</span>
        <input type="text" class="form-control" value="<?php echo $message['date_reception']?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Emetteur du message</span>
        <input type="text" class="form-control" value="<?php echo $message['login_name_expediteur']?>" readonly aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Contenu du message</span>
        <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $message['corps']?></textarea>
    </div>
    <a class="btn btn-success" href="answerMessage.php?login=<?php echo $message['login_name_expediteur']
        . '&sujet=' . $message['sujet'] ?>" role="button">Répondre</a>
    <a class="btn btn-warning" type="submit" href="messagerie.php?supprID=<?php echo $message['id']?>" role="button">Supprimer</a>
</div>
</body>
<!-- https://github.com/CapitainMorgan/ProjetBDR/blob/main/src/php/vueOffreEmploi.php -->
<?php

