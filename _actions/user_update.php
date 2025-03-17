<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
    
if(!$auth|| $auth->role_id != 2) {
    HTTP::redirect("admin/login.php", "auth=fail");
    exit();
}

$table = new UsersTable(new MySQL);
$table->updateUser([
    "id" => $_POST["id"],
    "name" => $_POST["name"],
    "email" => $_POST["email"]
]);

HTTP::redirect("admin/user_lists.php", "update=success");