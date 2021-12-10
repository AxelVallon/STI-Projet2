<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("message.php?error=403");
include "include/header.php"?>
<body>
<div class="container mt-3">
    <form method="post" action="createUser.php">
        <br><h2>Créer un utilisateur</h2><br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom d'utilisateur</span>
            <input type="text" class="form-control" name="login_name" aria-label="Username" placeholder="Username" required aria-describedby="basic-addon1">
        </div>
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
