<?php

include "../vendor/autoload.php";

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();

$id = $_GET["id"];
$post_id = $_GET["post"];

$table = new UsersTable(new MySQL());
$table->deleteComment($id);

HTTP::redirect("blogdetail.php", "id=$post_id");