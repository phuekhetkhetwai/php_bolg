<?php

include "vendor/autoload.php";

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();

$content = $_POST["content"];
$post_id = $_POST["id"];
$author_id = $auth->id;

$table = new UsersTable(new MySQL());

if(empty($content)){

    HTTP::redirect("blogdetail.php" , "id=$post_id&content=require");

}else {

    $table->addComment([
        "content" => $content,
        "author_id" => $author_id,
        "post_id" => $post_id
    ]);

    HTTP::redirect("blogdetail.php" , "id=$post_id");

}

