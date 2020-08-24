<?php


class User
{
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cleanInput($string) {
        $string = htmlspecialchars($string);
        $string = trim($string);
        $string = stripcslashes($string);

        return $string;
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `email` = :email AND `password` = :password");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $password = md5($password);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();

        if ($count > 0) {
            $_SESSION['user_id'] = $user->user_id;
            header('Location: home.php');
        } else {
            return false;
        }
    }

    public function userData($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function logout() {
        $_SESSION = array();
        session_destroy();
        header('location:../index.php');
    }

}