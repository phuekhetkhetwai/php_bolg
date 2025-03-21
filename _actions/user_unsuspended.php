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
$id = $_GET["id"];
$pageno = $_GET["pageno"];


$table = new UsersTable(new MySQL());
$table->unsuspended([
    "id" => $id,
    "suspended" => 0
]);

HTTP::redirect("admin/user_lists.php", "pageno=$pageno");