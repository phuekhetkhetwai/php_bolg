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
            background-color: #fff;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forms {
            width: 400px;
            background-color: #f4f4f4;
            box-sizing: 0 2px 5px rgba(0,0,0,0.6);

            border: 1px solid #fff;

            border-radius: 5px;

            padding: 20px;

        }

        .form-control::placeholder{
            font-size: 13px;
            color: #8b8b8b;
        }

    </style>
</head>
<body>
        <div class="container" style="width: 800px;">
            <?php if(isset($_GET["incorrect"])):?>
                <div class="alert alert-warning mb-3"><i class="fa-solid fa-exclamation-circle me-2"></i> Incorrect Email and Password</div>
            <?php endif ?>
            <?php if(isset($_GET["register"])):?>
                <div class="alert alert-info mb-3"><i class="fa-solid fa-circle-info me-2"></i> Successfully register!!You can Login now.</div>
            <?php endif ?>
            <?php if(isset($_GET["suspended"])):?>
                <div class="alert alert-danger mb-3"><i class="fa-solid fa-circle-info me-2"></i>Account suspended !!</div>
            <?php endif ?>
            <h3 class="text-center">Login</h3>
            <div class="d-flex justify-content-center ">
                <form action="_actions/user_login.php" method="post" class="m-4 forms">
                    <div class="form-group mb-3">
                        <label for="email" class="mb-2">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="mb-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                    </div>
                    <div class="form-group d-grid my-3">
                        <button type="submit" class="btn btn-primary mb-3">Login</button>
                        <a href="register.php" class="btn btn-secondary">Sing Up</a>    
                    </div>
                </form>
            </div>
            
        </div>
    
    <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>