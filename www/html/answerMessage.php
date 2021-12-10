<?php
include_once "classes/AccessControl.php";
AccessControl::connectionVerification("index.php?error=401");
include_once "include/header.php";
?>

<body>
<div class="container mt-3">
    <label for="exampleFormControlTextarea1" class="form-label">Votre réponse</label><br>
    <form action="messageCreation.php" method="post">
        <input hidden name="destinataire" value="<?php echo $_GET['login']?>" />
        <input hidden name="sujet" value="<?php echo $_GET['sujet']?>">
        <div class="input-group mb-3">
            <textarea required class="form-control" name="corps" id="exampleFormControlTextarea1" rows="5"></textarea>
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Envoyer à<br><?php echo $_GET['login'] ?></php></button>
        </div>
    </form>
</div>
</body>