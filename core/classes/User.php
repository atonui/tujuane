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
}