<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Formulaire pour envoyer un message
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php";
CSRF::updateToken();
?>

<body>
<div class="container mt-3">
    <form method="post" action="messageCreation.php">
        <?php CSRF::insertHiddenInput() ?>
        <br><h2>Envoyer un message</h2><br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Sujet</span>
            <input type="text" class="form-control" name="sujet" aria-label="Username" required aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Destinataire</span>
            <input type="text" class="form-control" name="destinataire" aria-label="Username" required aria-describedby="basic-addon1">
        </div>
        <label class=form-control" style="color: red" id="error"></label><br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Contenu du message</span>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="corps" required rows="5"></textarea>
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Envoyer</button>
        </div>
    </form>
</div>
</body>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'user_dont_exist') {
        echo '<script type="text/JavaScript"> 
                const error = document.getElementById("error");
                // Changing content and color of content
                error.innerText = "Vous ne pouvez pas envoyer un message à un utilisateur n\'existant pas"
            </script>';
    }
}