<?php
    include "../vendor/autoload.php";
    include "../_actions/token.php";
    include "../_actions/common.php";

    use Helpers\Auth;
    use Helpers\HTTP;
    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    $auth = Auth::check();
    
    if(!$auth|| $auth->role_id != 2) {
        HTTP::redirect("admin/login.php", "auth=fail");
        exit();
    }

    $table = new UsersTable(new MySQL);
    $post = $table->edit($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
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
            <div class="col-lg-6 mx-auto pt-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="text-primary ms-3 my-3"><i class="fa-solid fa-pen-to-square"></i>Edit Blog</h5>
                        <?php if(isset($_GET["type"])): ?>
                            <div class="alert alert-warning ms-3">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            image must be jpg or png.
                            </div>
                        <?php endif ?>

                        <form action="../_actions/update.php" method="post" enctype="multipart/form-data" class="px-3">
                        <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?>">
                            <input type="hidden" name="id" value="<?php echo $post->id ?>">
                            <div class="form-group my-3">
                                <label for="title" class="fw-bold my-2">Title</label>
                                <span class="text-danger"><?php echo isset($_GET["title"]) ? "* Title cannot be null" : "" ?></span>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo escape($post->title) ?>" placeholder="Title">
                            </div>

                            <div class="form-group my-3">
                                <label for="content" class="fw-bold my-2">Content</label>
                                <span class="text-danger"><?php echo isset($_GET["content"]) ? "* Content cannot be null" : "" ?></span>

                                <textarea type="text" name="content" id="content" class="form-control" rows="7" placeholder="Content"><?php echo escape($post->content) ?></textarea>
                            </div>

                            <div class="form-group my-3">
                                
                                <label for="image" class="fw-bold my-2">Image</label><br>
                                <img src="../_actions/photos/<?= $post->image ?>" alt="image" id="img" width="150px" height="150px">
                                <input type="file" name="image" id="image" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                            </div>

                            <div class="form-group mt-4">
                                <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-angles-left me-2"></i>Back</a>
                                <button type="submit" class="btn btn-primary">Update<i class="fa-solid fa-paper-plane ms-2"></i></button>
                                
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