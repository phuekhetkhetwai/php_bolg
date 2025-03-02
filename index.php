<?php

include "vendor/autoload.php";

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$results = $table->getBlogs();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="bg-info fixed-top d-flex justify-content-between p-2" style="background-color: transparent;">
        <div class="ms-5">
            <h3>Blogs</h3>
        </div>
        <div class="d-flex justify-content-end">
            <div>
                <a href="#" class="nav-link d-block">
                    <?php echo $auth->name ?>
                </a>
            </div>
            <div class="mx-2">
                <img src="img2.avif" class="rounded-circle" alt="User Image" width="30px">
            </div>
            <?php if($auth->role_id == 2):?>
                <div class="me-2">
                    <a href="admin/index.php" class="nav-link text-primary">Admin</a>
                </div> 
            <?php endif ?>
        </div>
    </nav>

    <div class="container-fluid" style="margin: 100px 0;">
        <div class="row my-4 px-5">
            <?php foreach($results as $result): ?>
                <div class="col-md-4 col-sm-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center"><?php echo $result->title?></h5>
                            </div>
                            <div class="card-body">
                                <img src="img2.avif" alt="" style="width: 100%;height: 250px">
                                <p class="my-3" style="width: 100%;height: 60px"><?php echo strlen($result->content) > 100 ? substr($result->content,0 , 100) . " ..." : $result->content ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="blogdetail.php?id=<?=$result->id?>" class="nav-link text-primary">show more >>></a>
                            </div>
                        </div>
                </div>
            <?php endforeach ?>
        </div>
        <footer class="fixed-bottom p-3" style="background-color: #f4f4f4;">
            <div class="float-end d-none d-sm-inline">
                <a href="_actions/logout.php" class="btn btn-outline-secondary">Logout</a>
            </div>
            <strong>Copyright &copy; 2025 <a href="#">A Programmer</a>.</strong> All rights reserved.
        </footer>
    </div>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>