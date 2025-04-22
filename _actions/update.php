<?php
session_start();
include "../vendor/autoload.php";
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

$id = $_POST["id"];
$title = $_POST["title"];
$content = $_POST["content"];
$name = $_FILES["image"]["name"];
$type = $_FILES["image"]["type"];
$tmp_name = $_FILES["image"]["tmp_name"];

$data = [
    "id" => $id,
    "title" => $title,
    "content" => $content,
    "image" => $name
];

$table = new UsersTable(new MySQL);

if(empty($title) || empty($content)){

    if(empty($title)){

        HTTP::redirect("admin/edit.php", "title=require&id=$id");
    }elseif(empty($content)){

        HTTP::redirect("admin/edit.php", "content=require&id=$id");

    }
}else{
    if(empty($name)) {

        $table->update($data);
    
        HTTP::redirect("admin/index.php");
    
    }else{
        if($type === "image/jpeg" || $type === "image/png"){
            move_uploaded_file($tmp_name, "photos/$name");
    
            $table->update($data);
    
            HTTP::redirect("admin/index.php");
    
        }else{
    
            HTTP::redirect("admin/edit.php", "type=error&id=$id");
        }
    }
}
