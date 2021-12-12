<?php
date_default_timezone_set('UTC');
session_start();

class DB {
    private $pdo;
    public function __construct()
    {
        try{
            $pdo = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function login($login){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Compte WHERE login_name = :login AND est_valide ='1'");
            $stmt->execute(array(':login' => $login));
            return $stmt->fetch();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getAllMessage($login_name){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Message WHERE login_name_destinataire = :login ORDER BY date_reception DESC");
            $stmt->execute(array(':login' => $login_name));
            return $stmt->fetchAll();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteMessage($supprID)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Message WHERE id = :id ");
            $stmt->execute(array(':id' => $supprID));
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function createMessage($date_reception, $corps, $sujet, $login_name_expediteur, $login_name_destinataire){
        try {
             $stmt = $this->pdo->prepare("INSERT INTO Message (date_reception, corps, sujet, " .
                 " login_name_expediteur, login_name_destinataire) " .
                " VALUES ( :date_reception , :corps , :sujet , :login_name_expediteur, :login_name_destinataire )");
             $stmt->bindParam(':date_reception', $date_reception);
             $stmt->bindParam(':corps', $corps);
             $stmt->bindParam(':sujet', $sujet);
             $stmt->bindParam(':login_name_expediteur', $login_name_expediteur);
             $stmt->bindParam(':login_name_destinataire', $login_name_destinataire);
             $stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
}

    public function getMessage($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Message WHERE id = :id");
            $stmt->execute(array(':id' => $id));
            return $stmt->fetch();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function createUser($login_name, $mot_de_passe, $est_valide, $est_admin)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Compte (login_name, mot_de_passe, est_valide, est_admin) " .
               " VALUES ( :login_name , :mot_de_passe , :est_valide , :est_admin)");
            $stmt->bindParam(':login_name', $login_name);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->bindParam(':est_valide', $est_valide);
            $stmt->bindParam(':est_admin', $est_admin);
            $stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function deleteUser($login_name)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Compte WHERE login_name = :login_name");
            $stmt->execute(array(':login_name' => $login_name));
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getAllUser()
    {
        try {
            $query = $this->pdo->query("SELECT * FROM Compte");
            return $query->fetchAll();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updateUser($login_name, $mot_de_passe, $est_valide, $est_admin)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE Compte SET mot_de_passe = :mot_de_passe , " .
                 "est_valide = :est_valide , est_admin = :est_admin WHERE login_name =  :login_name");
            $stmt->bindParam(':login_name', $login_name);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->bindParam(':est_valide', $est_valide);
            $stmt->bindParam(':est_admin', $est_admin);
            $stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }
    public function updateUserWithoutPassword($login_name, $est_valide, $est_admin)
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE Compte SET est_valide = :est_valide , est_admin = :est_admin WHERE login_name =  :login_name");
            $stmt->bindParam(':login_name', $login_name);
            $stmt->bindParam(':est_valide', $est_valide);
            $stmt->bindParam(':est_admin', $est_admin);
            $stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function updatePassword($login_name, $mot_de_passe)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE Compte SET mot_de_passe = :mot_de_passe WHERE login_name = :login_name");
            $stmt->bindParam(':login_name', $login_name);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function fetchOneMember($login_name){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Compte WHERE login_name = :login_name");
            $stmt->bindParam(':login_name', $login_name);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }
}