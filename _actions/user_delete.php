<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

Auth::check();

$table = new UsersTable(new MySQL);
$table->deleteUser($_GET["id"]);

HTTP::redirect("admin/user_lists.php");