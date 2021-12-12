<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Formulaire de création d'un utilisateur
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("message.php?error=403");
CSRF::updateToken();
include "include/header.php"?>
<body>
<div class="container mt-3">
    <form method="post" action="createUser.php">
        <?php CSRF::insertHiddenInput() ?>
        <br><h2>Créer un utilisateur</h2><br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom d'utilisateur</span>
            <input type="text" class="form-control" name="login_name" aria-label="Username" placeholder="Username"
                   required aria-describedby="basic-addon1">
        </div>
        <label class=form-control" style="color: red" id="error"></label><br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mot de passe</span>
            <input type="password" id="inputPassword" name="mot_de_passe" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="est_valide" value="" id="flexCheckChecked" checked>
            <label class="form-check-label" for="flexCheckChecked">
                Activation du compte
            </label>
        </div>
        <div class="form-check" style="margin-top: 7px">
            <input class="form-check-input" type="checkbox" name="est_admin" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Compte administrateur
            </label>
        </div>
        <br>
        <div class="input-group mb-3">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Créer</button>
        </div>
    </form>
</div>
</body>
<?php
if (isset($_GET['error'])){
    if ($_GET['error'] == 'user_already_exist'){
        echo '<script type="text/JavaScript"> 
                const error = document.getElementById("error");
                // Changing content and color of content
                error.innerText = "Cet utilisateur existe déjà. Veuillez en choisir un autre."
            </script>';
    }
    if ($_GET['error'] == 'invalid_password_format'){
    echo '<script type="text/JavaScript">
        alert("Un mot de passe doit respecter les conditions suivantes : \n" +
            "Doit avoir un minimum de 8 charactère \n" +
            "Doit avoir au moins un nombre\n" +
            "Doit avoir au moins une majuscule\n" +
            "Doit avoir au moins une minuscule\n" +
            "Doit avoir au moins un charactère spécial (#?!@$%^&*-)")
    </script>';
    }
}
