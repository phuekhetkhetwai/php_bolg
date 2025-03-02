<?php

include "vendor/autoload.php";

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$user = Auth::check();
$table = new UsersTable(new MySQL);
$result = $table->blogDetail($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <nav class="bg-info fixed-top d-flex justify-content-between p-2" style="background-color: transparent;">
        <h3 class="ms-5">Blogs</h3>
        <div class="d-flex justify-content-end">
          <div class="image">
            <img src="img2.avif" class="rounded-circle" alt="User Image" width="30px">
          </div>
          <div class=" mx-2">
            <a href="#" class="nav-link d-block">
                <?php echo $user->name ?>
            </a>
          </div>
        </div>
        </div>
    </nav>
    <div class="container-fluid" style="margin: 100px 0;">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center"><?php echo $result->title ?></h5>
                    </div>
                    <div class="card-body">
                        <img src="img2.avif" alt="" style="width: 100%;height: 400px">
                        <p class="my-3"><?php echo $result->content ?></p>
                    </div>
                    <div class="card-footer py-3">
                        <div class="mb-2">
                            <p><span class="fw-bold">Bob : </span><span class="text-muted">hi</span></p>
                        </div>
                        <div class="mb-2">
                            <p><span class="fw-bold">Bob : </span><span class="text-muted">hi</span></p>
                        </div>
                        <form action="" method="post" class="mt-3">
                            <div class="form-group">
                                <label for="comment" class="h5 mb-3"><i class="fa-solid fa-user-pen"></i> Comments</label>
                                <input type="text" name="comment" id="comment" class="form-control form-control-sm" placeholder="Enter post comment...">
                            </div>
                        </form>
                        <div class="float-end mt-3">
                            <a href="index.php" class="btn btn-sm btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="fixed-bottom p-3" style="background-color: #f4f4f4;">
        <div class="float-end d-none d-sm-inline">
            <a href="_actions/logout.php" class="btn btn-outline-secondary">Logout</a>
        </div>
        <strong>Copyright &copy; 2025 <a href="#">A Programmer</a>.</strong> All rights reserved.
    </footer>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>