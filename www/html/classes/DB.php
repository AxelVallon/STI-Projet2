<?php
date_default_timezone_set('UTC');
session_start();
class DB {
    private $file_db;
    private function connect()
    {
        $this->file_db = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
        $this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function disconnect(){
        $this->file_db = null;
    }

    public function login($login){
        try {
            $this->connect();
            $stmt = $this->file_db->query("SELECT * FROM Compte WHERE login_name ='" . $login . "' AND est_valide ='1'");
            $result = $stmt->fetch();
            $this->disconnect();
            return $result;
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function getAllMessage($login_name){
        try {
            $this->connect();
            $query = $this->file_db->query("SELECT * FROM Message WHERE login_name_destinataire ='" . $login_name . "' ORDER BY date_reception DESC");
            $result = $query->fetchAll();
            $this->disconnect();
            return $result;
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function deleteMessage($supprID)
    {
        try {
            $this->connect();
            $this->file_db->exec("DELETE FROM Message WHERE id ='" . $supprID . "'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function createMessage($date_reception, $corps, $sujet, $login_name_expediteur, $login_name_destinataire){
        try {
            $this->connect();
             $this->file_db->exec("INSERT INTO Message (date_reception, corps, sujet, login_name_expediteur, login_name_destinataire)
                VALUES ( '$date_reception' , '$corps' , '$sujet' , '$login_name_expediteur', '$login_name_destinataire')");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
}

    public function getMessage($id)
    {
        try {
            $this->connect();
            $query = $this->file_db->query("SELECT * FROM Message WHERE id ='" . $id . "'");
            $result = $query->fetch();
            $this->disconnect();
            return $result;
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function createUser($login_name, $mot_de_passe, $est_valide, $est_admin)
    {
        try {
            $this->connect();
            $this->file_db->exec("INSERT INTO Compte (login_name, mot_de_passe, est_valide, est_admin)
                VALUES ( '$login_name' , '$mot_de_passe' , '$est_valide' , '$est_admin')");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function deleteUser($login_name)
    {
        try {
            $this->connect();
            $this->file_db->exec("DELETE FROM Compte WHERE login_name ='" . $login_name . "'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function getAllUser()
    {
        try {
            $this->connect();
            $query = $this->file_db->query("SELECT * FROM Compte");
            $result = $query->fetchAll();
            $this->disconnect();
            return $result;
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function updateUser($login_name, $mot_de_passe, $est_valide, $est_admin)
    {
        try {
            $this->connect();
            $this->file_db->exec("UPDATE Compte SET mot_de_passe = '$mot_de_passe' , " .
                 "est_valide = '$est_valide' , est_admin = '$est_admin' WHERE login_name =  '$login_name'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }
    public function updateUserWithoutPassword($login_name, $est_valide, $est_admin)
    {
        try {
            $this->connect();
            $this->file_db->exec("UPDATE Compte SET est_valide = '$est_valide' , est_admin = '$est_admin' WHERE login_name =  '$login_name'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function updatePassword($login_name, $mot_de_passe)
    {
        try {
            $this->connect();
            $this->file_db->exec("UPDATE Compte SET mot_de_passe = '$mot_de_passe' WHERE login_name =  '$login_name'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }
}