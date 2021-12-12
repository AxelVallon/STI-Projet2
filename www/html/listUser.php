<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Affiche tous les utilisateur du site avec la possibilité de modifier leur mot de passe, leur validité
 *            et leur rôle.
 */

include_once "classes/AccessControl.php";
include_once "classes/CSRF.php";
include_once "classes/XSS.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("messagerie.php?error=403");

include_once "classes/DB.php";
$db = new DB();

if (isset($_GET['delete_login_name'])){
    CSRF::verification($_POST['token']);
    $db->deleteUser($_GET['delete_login_name']);
    header("Location: listUser.php");
}

CSRF::updateToken();
include_once "include/header.php";

$users = $db->getAllUser();
?>

    <body>
    <div class="container mt-3">
        <br><h2>Liste des utilisateurs</h2><br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Login</th>
                <th scope="col">Hached Password</th>
                <th scope="col">Edit password</th>
                <th scope="col">Est valide</th>
                <th scope="col">Est admin</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user){ ?>
                <tr>
                    <form action="updateUser.php" method="post">
                        <input hidden name="old_login_name" value="<?php echo XSS::textSanitizer($user['login_name']) ?>">
                        <?php CSRF::insertHiddenInput()?>
                        <td><input value="<?php echo XSS::textSanitizer($user['login_name']) ?>" name="login_name" readonly></td>
                        <td><input value="<?php echo XSS::textSanitizer($user['mot_de_passe']) ?>" readonly></td>
                        <td><input name="mot_de_passe" placeholder="Vide pour ne pas changer"></td>
                        <td>
                            <input class="form-check-input" type="checkbox" name="est_valide" id="flexCheckChecked" <?php echo $user['est_valide'] == '1' ? 'checked' : ''?>>
                        </td>
                        <td>
                            <input class="form-check-input" type="checkbox" name="est_admin" id="flexCheckChecked" <?php echo $user['est_admin'] == '1' ? 'checked' : ''?>>
                        <td>
                            <button class="btn btn-success" type="submit">Update</button>
                        </td>
                    </form>
                    <td>
                        <form method="post" action="listUser.php?delete_login_name=<?php echo XSS::textSanitizer($user['login_name']) ?>">
                            <?php CSRF::insertHiddenInput(); ?>
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
if (isset($_GET['error'])){
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
