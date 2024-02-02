<?php
require_once 'database\connexion.php';
require_once 'users.php';
class Utilisateur{
    private $pdo;
    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection(); 
    }

    public function add_User($username, $email, $phone, $password, $type) {
        $query = "INSERT INTO Utilisateur (username, email, phone, password, type) 
                  VALUES (:username, :email, :phone, :password, :type)";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $user_id = $this->pdo->lastInsertId();
        if ($type == "Auteur") {
            $queryAuteur = "INSERT INTO Auteur (utilisateur_id) VALUES (:user_id)";
            $stmtAuteur = $this->pdo->prepare($queryAuteur);
            $stmtAuteur->bindParam(':user_id', $user_id);
            $stmtAuteur->execute();
        } elseif ($type == "Administrateur") {
            $queryAdmin = "INSERT INTO Administrateur (utilisateur_id) VALUES (:user_id)";
            $stmtAdmin = $this->pdo->prepare($queryAdmin);
            $stmtAdmin->bindParam(':user_id', $user_id);
            $stmtAdmin->execute();
        }
    }
    public function Delete_user($id){
        $delete = "DELETE FROM utilisateur where id = $id;";
        $stmt = $this->pdo->prepare($delete);
        $stmt->execute();
        return $stmt;
    }

}



?>