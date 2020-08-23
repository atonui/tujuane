<?php

include  'database/connection.php';
include 'classes/User.php';
include 'classes/Follow.php';
include 'classes/Tweet.php';

global $pdo;

session_start();

$getFromUser = new User($pdo);
$getFromFollow = new Follow($pdo);
$getFromTweet = new Tweet($pdo);

define("BASE_URL", "http://localhost/twitter/");
