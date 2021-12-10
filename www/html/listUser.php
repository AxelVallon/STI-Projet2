<?php
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

