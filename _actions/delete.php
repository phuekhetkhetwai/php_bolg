<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

Auth::check();

$table = new UsersTable(new MySQL);
$table->delete($_GET["id"]);

HTTP::redirect("admin/index.php");