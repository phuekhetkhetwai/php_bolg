<?php

include "vendor/autoload.php";
// include "common.php";

// echo $_POST["_token"];
// echo $_SESSION["_token"];
// exit();

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$email = $_POST["email"];
$password = $_POST["password"];

$table = new UsersTable(new MySQL);
$user = $table->find($email,$password);

if($user && $user->role_id == 2) {
    session_start();
    $_SESSION["user"] = $user;
    HTTP::redirect("admin/index.php");

}else {
    HTTP::redirect("admin/login.php", "incorrect=login");
}

// print_r($_POST);