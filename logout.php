<?php
session_start();
include_once("userstorage.php");
include_once("auth.php");
include_once("utils.php");
$auth = new Auth(new UserStorage());

$auth->logout();
redirect("login.php");