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

    public function register($email, $screenName, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`, `screenName`, `profileImage`, `profileCover`, `bio`, `country`, `website`) VALUES ('username', :email, :password, :screenName, 'assets/images/defaultProfileImage.png', 'assets/images/defaultCoverImage.png', 'bio', 'country', 'website')");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $password = md5($password);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":screenName", $screenName, PDO::PARAM_STR);
        $stmt->execute();
        $user_id = $this->pdo->lastInsertId();
        $_SESSION['user_id'] = $user_id;
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

    public function checkEmail($email) {
        $stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $count = $stmt->rowCount();
        return ($count > 0) ? true : false;
    }

}