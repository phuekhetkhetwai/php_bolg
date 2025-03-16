<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

Auth::check();

$table = new UsersTable(new MySQL);
$table->updateUser([
    "id" => $_POST["id"],
    "name" => $_POST["name"],
    "email" => $_POST["email"]
]);

HTTP::redirect("admin/user_lists.php", "update=success");