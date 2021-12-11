<?php
/**
 * Auteurs  : Noémie Plancherel et Axel Vallon
 * Date     : 11.12.2021
 * But      : Affiche tous les utilisateur du site avec la possibilité de modifier leur mot de passe, leur validité
 *            et leur rôle.
 */

include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
AccessControl::adminVerification("messagerie.php?error=403");
include_once "include/header.php";
include_once "classes/DB.php";
$db = new DB();

if (isset($_GET['delete_login_name'])){
    $db->deleteUser($_GET['delete_login_name']);
    header("Location: listUser.php");
}
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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user){ ?>
                <tr>
                    <form action="updateUser.php" method="post">
                        <input hidden name="old_login_name" value="<?php echo $user['login_name'] ?>">
                        <td><input value="<?php echo $user['login_name'] ?>" name="login_name" readonly></td>
                        <td><input value="<?php echo $user['mot_de_passe'] ?>" readonly></td>
                        <td><input name="mot_de_passe" placeholder="Vide pour ne pas changer"></td>
                        <td>
                            <input class="form-check-input" type="checkbox" name="est_valide" id="flexCheckChecked" <?php echo $user['est_valide'] == '1' ? 'checked' : ''?>>
                        </td>
                        <td>
                            <input class="form-check-input" type="checkbox" name="est_admin" id="flexCheckChecked" <?php echo $user['est_admin'] == '1' ? 'checked' : ''?>>
                        <td>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a class="btn btn-warning" type="submit" href="listUser.php?delete_login_name=<?php echo $user['login_name']?>" role="button">Supprimer</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
    <!-- https://github.com/CapitainMorgan/ProjetBDR/blob/main/src/php/vueOffreEmploi.php -->
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
