<?php
session_start();
include "_actions/token.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            height: 100vh;
            background-color: #f4f4f4;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forms {
            width: 500px;
            background-color: #f4f4f4;

            border-radius: 10px;

            padding: 25px;

        }

        .form-control::placeholder{
            font-size: 13px;
            color: #8b8b8b;
        }

        .links {
            font-size: 14px;
        }

        .links:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
        <div>
            <?php if(isset($_GET["incorrect"])):?>
                <div class="alert alert-warning mb-3"><i class="fa-solid fa-exclamation-circle me-2"></i> Incorrect Email and Password</div>
            <?php endif ?>
            <?php if(isset($_GET["register"])):?>
                <div class="alert alert-info mb-3"><i class="fa-solid fa-circle-info me-2"></i> Successfully register!!You can Login now.</div>
            <?php endif ?>
            <?php if(isset($_GET["suspended"])):?>
                <div class="alert alert-danger mb-3"><i class="fa-solid fa-circle-info me-2"></i>Account suspended !!</div>
            <?php endif ?>
            <h3 class="text-center">User Login</h3>
            <div class="d-flex justify-content-center">
                <form action="_actions/user_login.php" method="post" class="m-3 shadow forms">
                    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">
                    <div class="form-group my-3 pt-2">
                        <label for="email" class="mb-3"><i class="fa-solid fa-envelope mx-2"></i>Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="mb-3"><i class="fa-solid fa-lock mx-2"></i>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                    </div>
                    <div class="form-group d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mb-3">Sign In</button>    
                    </div>
                    <a href="register.php" class="nav-link text-primary mb-2 links">Don't have an account?Signup here</a>
                </form>
            </div>
            
        </div>
    
    <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>