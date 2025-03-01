<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
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

    </style>
</head>
<body>
        <div>
            <h3 class="text-center">Register</h3>
            <form action="_actions/register.php" method="post" class="forms m-4">
                <div class="form-group mb-3">
                    <label for="name" class="mb-2">Name</label>
                    <input type="name" name="name" id="name" class="form-control" placeholder="Name...">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="mb-2">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email...">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                </div>
                <div class="form-group d-grid my-3">
                    <button type="submit" class="btn btn-primary mb-3">Sign Up</button>
                    <a href="login.php" class="btn btn-secondary mb-3">Login</a>  
                </div>
            </form>
        </div>
    
    <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>