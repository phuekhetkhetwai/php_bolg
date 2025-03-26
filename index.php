<?php

include "vendor/autoload.php";
include "_actions/common.php";

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$posts = $table->getBlogs();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
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
                                    <h5 class="ms-5">Blogs</h5>
                                    <!-- start notify & user account -->
                                    <ul class="navbar-nav me-5">
                                        <!-- user account -->
                                        <li class="nav-item dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <span class="me-2"><?php echo escape($auth->name) ?></span>
                                                <img src="img/user.png" class="rounded-circle" width="25"
                                                    alt="user img">
                                            </a>
                                            <div class="dropdown-menu">
                                                <?php if($auth->role_id == 2):?>
                                                    <a href="admin/index.php" class="dropdown-item">
                                                    <i class="fa-solid fa-user text-muted me-2"></i>Admin
                                                    </a>
                                                <?php endif ?>
                                                <a href="_actions/logout.php" class="dropdown-item">
                                                <i class="fa-solid fa-arrow-right-from-bracket text-muted me-2"></i>Logout
                                                </a>
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
    <section style="margin: 80px 0;">
        <div class="container">
            <div class="row">
                <?php foreach($posts as $post): ?>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center"><?php echo escape($post->title) ?></h5>
                            </div>
                            <div class="card-body">
                                <img src="_actions/photos/<?php echo $post->image ?>" alt="<?php echo $post->image ?>" style="width: 100%;height: 250px">
                                <p class="my-3" style="width: 100%;height: 60px"><?php echo strlen($post->content) > 100 ? escape(substr($post->content,0 , 100)) . " ..." : escape($post->content) ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="blogdetail.php?id=<?=$post->id?>" class="nav-link text-primary">show more >>></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- End Content Area -->

    <!-- Start Footer Section -->
    <footer class="fixed-bottom" style="background-color: #fff;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row border-top pt-3">
                        <div class="col-md-6 text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item me-2">
                                    <a href="javascript:void(0);">Example Technology Co.,Ltd</a>
                                </li>
                                <li class="list-inline-item me-2">
                                    <a href="javascript:void(0);">About</a>
                                </li>
                                <li class="list-inline-item me-2">
                                    <a href="javascript:void(0);">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-center">
                            <p>&copy; <span id="getyear">2000</span> Copyright. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->

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