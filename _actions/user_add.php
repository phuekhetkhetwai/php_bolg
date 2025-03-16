<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

Auth::check();


$table = new UsersTable(new MySQL);
$table->insert([
    "name" => $_POST["name"],
    "email" => $_POST["email"],
    "password" => $_POST["password"],
], "admin/user_create.php");

HTTP::redirect("admin/user_lists.php", "create=success");