<?php
include "../_actions/vendor/autoload.php";

use Helpers\Auth;

Auth::check();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
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
</head>
<body>
        <div class="container-fluid vh-100" style="background-color: rgba(225,225,225,0.2);">
            <div class="col-lg-6 mx-auto pt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-primary ms-3 pt-3"><i class="fa-solid fa-pen-to-square"></i>Add Blog</h5>
                        <?php if(isset($_GET["type"])): ?>
                            <div class="alert alert-warning ms-3">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            image must be jpg or png.
                            </div>
                        <?php endif ?>
                        <form action="../_actions/add.php" method="post" enctype="multipart/form-data" class="px-3">
                            <div class="form-group my-3">
                                <label for="title" class="fw-bold my-2">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title...">
                            </div>

                            <div class="form-group my-3">
                                <label for="content" class="fw-bold my-2">Content</label>
                                <textarea type="text" name="content" id="content" class="form-control" rows="12" placeholder="Content..."></textarea>
                            </div>

                            <div class="form-group my-3">
                                <label for="image" class="fw-bold my-2">Image</label><br>
                                <img src="" alt="image" id="img" width="150px" height="150px" style="display: none;">
                                <input type="file" name="image" id="image" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0]);document.getElementById('img').style.display = 'inline-block';">
                            </div>

                            <div class="form-group mt-4">
                                <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
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