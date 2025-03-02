<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$email = $_POST["email"];
$password = $_POST["password"];

$table = new UsersTable(new MySQL);
$user = $table->find($email,$password);

if($user) {
    session_start();
    $_SESSION["user"] = $user;
    HTTP::redirect("index.php");
}else {
    HTTP::redirect("login.php", "incorrect=login");
}

// print_r($_POST);