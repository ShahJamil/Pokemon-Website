<?php
include_once('userstorage.php');
include_once('auth.php');
// print_r($_GET);

$user_storage = new UserStorage();
$auth = new Auth($user_storage);

$username = $_GET["username"];


echo $auth->user_exists($username) ? 1 : 0;
