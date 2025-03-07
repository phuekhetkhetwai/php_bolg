<?php

include "vendor/autoload.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$user = Auth::check();

$title = $_POST["title"];
$content = $_POST["content"];
$name = $_FILES["image"]["name"];
$type = $_FILES["image"]["type"];
$tmp_name = $_FILES["image"]["tmp_name"];
$author_id = $user->id;

// print_r($_FILES["image"]);
// exit();

if($type == "image/jpeg" || $type == "image/png"){
    move_uploaded_file($tmp_name, "photos/$name");

    $table = new UsersTable(new MySQL);
    $table->add([
        "title" => $title,
        "content" => $content,
        "image" =>  $name,
        "author_id" => $author_id, 
    ]);

    HTTP::redirect("admin/index.php");

}else{
    HTTP::redirect("admin/create.php", "error=type");
}
