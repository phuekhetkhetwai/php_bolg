<?php
session_start();

include "vendor/autoload.php";
include "token.php";

use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
    
if(!$auth|| $auth->role_id != 2) {
    HTTP::redirect("admin/login.php", "auth=fail");
    exit();
}

$title = $_POST["title"];
$content = $_POST["content"];
$name = $_FILES["image"]["name"];
$type = $_FILES["image"]["type"];
$tmp_name = $_FILES["image"]["tmp_name"];
$author_id = $auth->id;

// print_r($_FILES["image"]);
// exit();

if( $type == "image/jpeg" || $type == "image/png"){

    if(empty($title) || empty($content)){

        if(empty($title)){

            HTTP::redirect("admin/create.php", "title=require");
        }elseif(empty($content)){

            HTTP::redirect("admin/create.php", "content=require");

        }
    }else {
        move_uploaded_file($tmp_name, "photos/$name");

        $table = new UsersTable(new MySQL);
        $table->add([
            "title" => $title,
            "content" => $content,
            "image" =>  $name,
            "author_id" => $author_id, 
        ]);

        HTTP::redirect("admin/index.php");

    }

}else{

    HTTP::redirect("admin/create.php", "type=error");
}
