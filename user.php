<?php
require_once './db.php';

class User extends DB
{
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public function __construct($name, $email, $password, $confirm_password)
    {
        parent::__construct();

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->connect();
    }

    public function create()
    {
        try {
            $password_encryption = md5($this->password);
            $sql = "INSERT INTO `user_data` (name, email, password) VALUES (:name, :email, :password)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $password_encryption);
            $stmt->execute();
            session_start();
            $_SESSION['name'] = $this->name;
            $_SESSION['email'] = $this->email;
            header("Location: home.php");
            exit();
        } catch (PDOException $e) {
            echo "Xeta msj: " . $e->getMessage();
        }
    }

    public function login($identifier, $password)
    {
        try {
            $sql = "SELECT * FROM `user_data` WHERE email= :identifier OR name = :identifier";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':identifier', $identifier);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && md5($password) === $user['password']) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                header("Location: home.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error message : " . $e->getMessage();
        }
    }

    public function emailExists($email): bool
    {
        try {
            $sql = "SELECT COUNT(*) AS count FROM `user_data` WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}



