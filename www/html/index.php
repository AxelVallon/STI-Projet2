<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Page de login
 */
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Messagerie</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js" ></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom styles for this template -->
    <link href="css/signing.css" rel="stylesheet">

</head>
<body class="text-center">
    <form class="form-signin" action="verificationLogin.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputLogin" class="sr-only">Login</label>
        <input name="inputLogin" type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <label class=form-control" style="color: red" id="error"></label><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
</body>
</html>

<?php
if (isset($_GET['error'])){
    if ($_GET['error'] == '401'){
        echo '<script type="text/JavaScript"> 
                alert("Merci de vous authentifier pour accéder à cette ressource")
            </script>';
    }
    else if ($_GET['error'] == 'invalid_credential'){
        echo '<script type="text/JavaScript"> 
               const error = document.getElementById("error");
                // Changing content and color of content
                error.innerText = "Echec de la connection"
            </script>';
    }
}
?>