<?php

$host = 'localhost';
$database = 'tweety';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host; dbname=$database; charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $exception) {
    throw new PDOException($exception->getMessage(), (int)$exception->getCode());
}
