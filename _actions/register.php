<?php
session_start();
include "../vendor/autoload.php";
include "token.php";

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$path = "register.php";


if (empty($name) || empty($email) || empty($password) || strlen($password) < 6 ) {

    if(empty($name)) HTTP::redirect("register.php", "name=require");

    elseif(empty($email)) HTTP::redirect("register.php", "email=require");

    elseif(empty($password)) HTTP::redirect("register.php", "password=require");

    elseif(!empty($password) && strlen($password) < 6 ) HTTP::redirect("register.php", "error=password");

} else {

    $table->insert([
        "name" => $name,
        "email" => $email,
        "password" => $password,
    ], $path);

    HTTP::redirect("login.php", "register=success");
}