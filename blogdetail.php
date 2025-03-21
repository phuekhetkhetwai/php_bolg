<?php

include "vendor/autoload.php";

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$post = $table->blogDetail($_GET["id"]);
$comments = $table->getComment($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detail</title>
    <!-- bootstrap css1 js1 -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <!-- fontawsome cdn css1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- jquery ui css1 js1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"></script>
    <!-- Custom Css -->
    <link rel="stylesheet" href="dist/css/style.css">
    <style>
        .form-control::placeholder{
            font-size: 13px;
            color: #8b8b8b;
        }

        .comments {
            cursor: pointer;
        } 

        .commentboxs{
            height: 0;
        }

        .commentboxs.heights{
            height: 100px;
            padding: 10px 0;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Start Content Area -->
    <section class="container-fluid mt-3">
        <div class="col-lg-8 mx-auto">
            <div class="py-3">
                    <h5 class="text-center text-uppercase"><?php echo $post->title?></h5>
                    <hr>
                
                <div class="border-bottom" style="overflow-y: scroll;height: 430px;">
                    <div class="float-start me-3" style="width: 50%;">
                    <img src="_actions/photos/<?php echo $post->image ?>" alt="<?php echo $post->image ?>" class="img-thumbnail" style="width: 100%;">
                    </div>
                    <p style="line-height: 25px;"><?php echo $post->content ?></p>
                </div>
            </div>
        </div>
        <div  class="fixed-bottom bg-white col-lg-8 mx-auto p-2">
            <ul class="list-group mt-2 rounded-0">
                <li class="list-group-item bg-secondary text-white comments"><i class="fa-solid fa-pen-to-square me-2"></i>Comments <span class="badge bg-white text-secondary float-end"><?php echo count($comments) ?></li>
            </ul>
            <?php if(!empty($comments)): ?>
                <div class="border rounded-0 commentboxs heights" style="overflow-y: scroll;">
                    <ul class="list-group ps-3">
                        <?php foreach($comments as $comment): ?>
                            <li class="list-unstyled mb-2">

                            <?php if($auth->id == $comment->author_id || $auth->role_id == 2): ?>
                                <a href="_actions/delete_comment.php?id=<?php echo $comment->id ?>&post=<?php echo $post->id ?>" class="btn-close float-end me-2"></a>
                            <?php endif ?>
                            
                            <b class="text-dark h6 fw-bold"><?php echo empty($comment->name) ? "deleted user" : $comment->name ?></b> <span class="fw-bold">:</span>
                            <?php echo $comment->content ?>
                            </li>
                        <?php endforeach ?>

                    </ul>
                </div> 
            <?php endif ?>
            
            <form action="_actions/add_comment.php" method="post" class="mt-2">
                <input type="hidden" name="id" value="<?php echo $post->id ?>">
                <div class="input-group">
                    <input type="text" name="content" id="content" class="form-control shadow-none" placeholder="Your comment...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                    <div>
                        <a href="index.php" class="btn btn-secondary ms-2">Back</a>
                        <a href="_actions/logout.php" class="btn btn-outline-secondary ms-2">Logout</a>
                    </div>
                </div>
            </form>
        </div>                 
    </section>
    <!-- End Content Area -->

    <!-- bootstrap css1 js1 -->
    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jquery ui css1 js1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js"></script>
    <!-- custom js -->
    <script>
        const getcomments = document.querySelector(".comments");
        const getcommentboxs = document.querySelector(".commentboxs");

        getcomments.addEventListener("click",function(){
            getcommentboxs.classList.toggle("heights");

        });

    </script>
</body>

</html>