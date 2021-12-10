<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php"?>

<body class="text-center">
<div class="container mt-3">

<form action="modifyPassword.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Modification du mot de passe</h1>
    <label for="inputLogin" class="sr-only">Mot de passe</label>
    <input type="password" id="inputPassword" name="inputPassword1" class="form-control" placeholder="Password" required>
    <label for="inputPassword" class="sr-only">Répetez le mot de passe</label>
    <input type="password" id="inputPassword" name="inputPassword2" class="form-control" placeholder="Password" required>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Modification du mot de passe</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
</form>
</div>
</body>
</html>