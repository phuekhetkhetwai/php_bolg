<?php

include "vendor/autoload.php";

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$post = $table->blogDetail($_GET["id"]);
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
</head>

<body>

    <!-- Start Navbar -->
    <div class="wrappers">
            <div id="nav" class="">
                <div class="container-fluid">
                    <div class="row">
                        <!-- start top side bar -->

                        <div class="col-md-12 fixed-top topnavbars">
                            <div class="row">
                                <div class="navbar navbar-expand navbar-light justify-content-between bg-white shadow">
                                    <h5 class="ms-5">Blogdetail</h5>
                                    <!-- start notify & user account -->
                                    <ul class="navbar-nav me-5">
                                        <!-- user account -->
                                        <li class="nav-item dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <span><?php echo $auth->name ?></span>
                                                <img src="img/user.png" class="rounded-circle" width="25"
                                                    alt="user img">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="index.php" class="dropdown-item"><i
                                                class="fa-solid fa-file text-muted me-2"></i>Blogs</a>
                                                <a href="_actions/logout.php" class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket text-muted me-2"></i>Logout</a>
                                            </div>
                                        </li>
                                        <!-- user account -->

                                    </ul>
                                    <!-- end notify & user account -->
                                </div>
                            </div>
                        </div>

                        <!-- end top side bar -->
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->

    <!-- Start Content Area -->
    <section class="container-fluid" style="margin: 80px 0;">
        <div class="col-lg-8 mx-auto">
            <div class="card p-3">
                <div class="card-header">
                    <h5 class="card-title text-center"><?php echo $post->title?></h5>
                </div>
                <div class="card-body">
                    <img src="_actions/photos/<?php echo $post->image ?>" alt="<?php echo $post->image ?>" class="img-thumbnail" style="width: 50%;height: 300px">
                    <p class="my-3" style="width: 100%;height: 60px"><?php echo $post->content ?></p>
                </div>
                <div class="card-footeer">
                    <p><span class="fw-bold">user : </span><span class="text-muted">comment</span></p>
                    <form action="" method="">
                        <label for="comment" class="h5 fw-bold mb-3"><i class="fa-solid fa-pen-to-square me-2"></i>Comments</label>
                        <div class="input-group">
                            <input type="text" name="comment" id="comment" class="form-control shadow-none" placeholder="Your comment...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
    <script src="dist/js/app.js"></script>
</body>

</html>