<?php
session_start();
include "vendor/autoload.php";
include "token.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
    
if(!$auth|| $auth->role_id != 2) {
    HTTP::redirect("admin/login.php", "auth=fail");
    exit();
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$path = "admin/user_create.php";

$table = new UsersTable(new MySQL);

if(empty($name) || empty($email) || empty($password) || strlen($password) < 6){
    if(empty($name)) HTTP::redirect("admin/user_create.php", "name=require");

    elseif(empty($email)) HTTP::redirect("admin/user_create.php", "email=require");

    elseif(empty($password)) HTTP::redirect("admin/user_create.php", "password=require");

    elseif(!empty($password) && strlen($password) < 6 ) HTTP::redirect("admin/user_create.php", "error=password");

}else{
    $table->insert([
        "name" => $name,
        "email" => $email,
        "password" => $password,
    ], $path);
    
    HTTP::redirect("admin/user_lists.php", "create=success");
}
