<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Liste les message d'un utilisateur
 */

include_once "classes/CSRF.php";
include_once "classes/AccessControl.php";
include_once "classes/XSS.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php";
include_once "classes/DB.php";
$db = new DB();
if (isset($_GET['supprID'])){
    CSRF::verification($_POST['token']);
    $db->deleteMessage($_GET['supprID']);
    header("Location: messagerie.php");
}
CSRF::updateToken();
$messages = $db->getAllMessage($_SESSION['login_name']);
?>

<body>
<div class="container mt-3">
    <br><h2>Mes messages</h2><br>
    <table class="table">
    <thead>
    <tr>
        <th scope="col">Émetteur</th>
        <th scope="col">Date réception</th>
        <th scope="col">Sujet</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($messages as $message){ ?>
        <tr>
            <td><?php echo XSS::textSanitizer($message['login_name_expediteur']) ?></td>
            <td><?php echo XSS::textSanitizer($message['date_reception']) ?></td>
            <td><?php echo XSS::textSanitizer($message['sujet']) ?></td>
            <td>
                <form method="post" action="messagerie.php?supprID=<?php echo XSS::textSanitizer($message['id'])?>">
                <a class="btn btn-success" href="answerMessage.php?login=<?php echo XSS::textSanitizer($message['login_name_expediteur'])
                    . '&sujet=' . XSS::textSanitizer($message['sujet']) ?>" role="button">Répondre</a>
                <a class="btn btn-info" href="detailsMessage.php?id=<?php echo XSS::textSanitizer($message['id'])?>" role="button">Détails</a>

                    <?php CSRF::insertHiddenInput() ?>
                    <button class="btn btn-warning" type="submit" role="button">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</body>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == '403') {
        echo '<script type="text/JavaScript"> 
                alert("Vous n\'avez pas les authorisations nécessaire pour accéder à cette ressource\n" +
                "Veuillez demander des droits supplémentaires à l\'administrateur de ce site")
            </script>';
    }
}

