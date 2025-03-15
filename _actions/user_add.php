<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$user = Auth::check();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

$table = new UsersTable(new MySQL);
