<?php
include "../vendor/autoload.php";
include "../_actions/token.php";

use Helpers\Auth;
use Helpers\HTTP;


$auth = Auth::check();
    
if(!$auth|| $auth->role_id != 2) {
    HTTP::redirect("admin/login.php", "auth=fail");
        exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <!-- fav icon -->
    <link rel="icon" href="assets/img/fav/favicon.png" sizes="16x16">
    <!-- bootstrap css1 js1 -->
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <!-- fontawsome css1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- jquery ui css1 js1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="../dist/css/style.css">
    <style>
        .form-control::placeholder{
            font-size: 13px;
            color: #8b8b8b;
        }
    </style>
</head>
<body>
    <div class="container-fluid vh-100" style="background-color: rgba(225,225,225,0.2);">
        <div class="col-lg-5 col-md-7 mx-auto" style="padding-top: 100px;">
            <div class="card p-3">
                <div class="card-body">
                    <h5 class="text-primary ms-3 py-2"><i class="fa-solid fa-user-pen me-2"></i>Add User</h5>
                    <?php if(isset($_GET["duplicated"])): ?>
                            <div class="alert alert-danger text-danger ms-3">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Email Duplicated!!!
                            </div>
                        <?php endif ?>
                    <form action="../_actions/user_add.php" method="post" class="px-3">
                        <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">

                        <div class="form-group my-3">
                            <label for="name" class="fw-bold my-2">Name</label>
                            <span class="text-danger"><?php echo isset($_GET["name"]) ? "* Name cannot be null" : "" ?></span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name...">
                        </div>

                        <div class="form-group my-3">
                            <label for="email" class="fw-bold my-2">Email</label>
                            <span class="text-danger"><?php echo isset($_GET["email"]) ? "* Email cannot be null" : "" ?></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
                        </div>

                        <div class="form-group my-3">
                            <label for="password" class="fw-bold my-2">Password</label>
                            <span class="text-danger"><?php echo isset($_GET["password"]) ? "* Password cannot be null" : "" ?></span>
                            <span class="text-danger"><?php echo isset($_GET["error"]) ? "* Password should be long" : "" ?></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                        </div>

                        <div class="form-group mt-4">
                            <a href="user_lists.php" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
                            <button type="submit" class="btn btn-primary">Submit<i class="fa-solid fa-paper-plane ms-2"></i></button>
                                    
                        </div>
                    
                    </form>
                </div>
            </div>
        </div> 
    </div>
    <!-- bootstrap css1 js1 -->
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jquery ui css1 js1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js"></script>
    <!-- custom js -->
    <script src="../dist/js/app.js"></script>
</body>
</html>