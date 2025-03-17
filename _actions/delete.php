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
$table->delete($_GET["id"]);

HTTP::redirect("admin/index.php");