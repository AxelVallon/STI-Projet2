<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Affichage de la page pour modifier son mot de passe
 */

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
    <label class=form-control" style="color: red" id="error"></label><br>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Modification du mot de passe</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
</form>
</div>
</body>
</html>
<?php
if (isset($_GET['error'])){
    if ($_GET['error'] == 'different_password'){
        echo '<script type="text/JavaScript"> 
                const error = document.getElementById("error");
                // Changing content and color of content
                error.innerText = "Les deux mots de passent doivent être identiques"
            </script>';
    }
    else if ($_GET['error'] == 'invalid_password_format'){
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
?>