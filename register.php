<?php
session_start();
include "_actions/token.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

            padding: 20px;

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
            <?php if(isset($_GET["duplicated"])):?>
                <div class="alert alert-danger text-danger ms-3">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>Email Duplicated!!!
                </div>
            <?php endif ?>
            <h3 class="text-center">Register</h3>
            <form action="_actions/register.php" method="post" class="forms shadow m-4">
                <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">
                <div class="form-group mb-3">
                    <label for="name" class="mb-3"><i class="fa-solid fa-user mx-2"></i>Name</label>
                    <span class="text-danger"><?php echo isset($_GET["name"]) ? "* Name cannot be null" : "" ?></span>
                    <input type="name" name="name" id="name" class="form-control" placeholder="Name...">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-3"><i class="fa-solid fa-envelope mx-2"></i>Email</label>
                    <span class="text-danger"><?php echo isset($_GET["email"]) ? "* Email cannot be null" : "" ?></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="mb-3"><i class="fa-solid fa-lock mx-2"></i>Password</label>
                    <span class="text-danger"><?php echo isset($_GET["password"]) ? "* Password cannot be null" : "" ?></span>
                    <span class="text-danger"><?php echo isset($_GET["error"]) ? "* Password should be long" : "" ?></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                </div>
                <div class="form-group d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary mb-3">Sign Up</button>    
                    </div>
                    <a href="login.php" class="nav-link text-primary mb-2 links">Already register?Signin here</a>
            </form>
        </div>
    
    <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>