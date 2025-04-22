<?php

include "../vendor/autoload.php";

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
    
if(!$auth|| $auth->role_id != 2) {
    HTTP::redirect("admin/login.php", "auth=fail");
    exit();
}

$pageno = $_GET["pageno"];

$table = new UsersTable(new MySQL());
$table->changeRole([
    "id" => $_GET["id"],
    "role_id" => $_GET["role"]
]);

HTTP::redirect("admin/user_lists.php", "pageno=$pageno");
