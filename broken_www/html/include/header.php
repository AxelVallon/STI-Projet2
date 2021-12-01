<?php session_start() ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Messagerie</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom styles for this template -->
</head>

<header>
    <div class="px-3 py-2 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <?php
                    if (isset($_SESSION['est_admin']) && $_SESSION['est_admin'] == '1'){?>
                        <li>
                            <a href="./createUserForm.php" class="nav-link text-white">
                                Créer un utilisateur
                            </a>
                        </li>
                        <li>
                            <a href="./listUser.php" class="nav-link text-white">
                                Liste des utilisateurs
                            </a>
                        </li>
                    <?php }
                    ?>
                    <li>
                        <a href="./messagerie.php" class="nav-link text-white">
                            Boîte de réception
                        </a>
                    </li>
                    <li>
                        <a href="sendMessage.php" class="nav-link text-white">
                            Envoyer un message
                        </a>
                    </li>
                    <li>
                        <a href="myProfile.php" class="nav-link text-white">
                             Changement de mot de passe
                        </a>
                    </li>
                    <li>
                        <a href="deconnection.php" class="nav-link text-white">
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>