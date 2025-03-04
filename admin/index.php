<?php
    session_start();
    $user = $_SESSION["user"];
    if($user->role_id != 2) {
        header("location: login.php?auth=fail");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Template</title>
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

    <!-- Start Navbar -->
    <div class="wrappers">
        <nav class="navbar navbar-expand-md navbar-light">
            <button type="button" class="navbar-toggler ms-auto mb-2" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="nav" class="">
                <div class="container-fluid">
                    <div class="row">
                        <!-- start left side bar -->
                        <div class="col-lg-2 col-md-3 fixed-top vh-100 overflow-auto leftsidebars">
                            <ul class="navbar-nav flex-column mt-4">

                                <li class="nav-item nav-categories">Main</li>
                                <li class="nav-item"><a href="index.php"
                                        class="nav-link text-white p-3 mb-2 sidebarlinks currents"><i
                                            class="fa-solid fa-file me-3"></i>BlogList</a></li>
                                <li class="nav-item"><a href="user_list.php"
                                        class="nav-link text-white p-3 mb-2 sidebarlinks"><i
                                            class="fa-solid fa-users me-3"></i>UserList</a></li>
                            </ul>
                        </div>

                        <!-- end left side bar -->

                        <!-- start top side bar -->

                        <div class="col-lg-10 col-md-9 fixed-top ms-auto topnavbars">
                            <div class="row">
                                <div class="navbar navbar-expand navbar-light bg-white shadow">
                                    <!-- start quick search -->
                                    <form action="" method="" class="me-auto">
                                        <div class="input-group">
                                            <input type="text" name="quicksearch" id="quicksearch"
                                                class="form-control border-0 shadow-none"
                                                placeholder="Search Something...">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quicksearchmodal">
                                                    <i class="fa-solid fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end quick search -->

                                    <!-- start notify & user account -->
                                    <ul class="navbar-nav me-5">

                                        <!-- user account -->
                                        <li class="nav-item dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <span class="small text-muted me-2">Admin</span>
                                                <img src="../img/user.png" class="rounded-circle" width="25"
                                                    alt="user1">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a href="../index.php" class="dropdown-item"><i
                                                        class="fa-solid fa-user text-muted me-2"></i>Blogs</a>
                                                <a href="../_actions/logout.php" class="dropdown-item"><i
                                                        class="fa-solid fa-user text-muted me-2"></i>Logout</a>
                                            </div>
                                        </li>
                                        <!-- user account -->

                                    </ul>
                                    <!-- end notify & user account -->

                                    <!-- start mobile close btn -->
                                    <button type="button" class="close-btns" data-bs-toggle="collapse"
                                        data-bs-target="#nav">
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                    <!-- end mobile close btn -->

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
    <section style="margin-top: 50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-9 ms-auto">
                    <div class="card">
                        <div class="card-body">
                            <table class="table tabel-striped">
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Hello</td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit ex excepturi hic sint itaque eos dolore fugit? Tempore autem enim, voluptates molestias pariatur voluptate deleniti magni repudiandae id, vero quasi.</td>
                                    <td>
                                        <a href="#"><i class="fa-solid fa-pen"></i></a>
                                        <a href="#" class="text-danger ms-3"><i class="fa-solid fa-trash-alt"></i></a>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Content Area -->

    <!-- Start Footer Section -->
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="fixed-bottom col-lg-10 col-md-9 ms-auto" style="z-index: -1;">
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

    
    <!-- Start Modal Area -->
    <div id="quicksearchmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Result</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="javascript:void(0);">WDF 1001</a></li>
                        <li class="list-group-item"><a href="javascript:void(0);">WDF 1002</a></li>
                        <li class="list-group-item"><a href="javascript:void(0);">WDF 1003</a></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
            
        </div>

    </div>
    <!-- End Modal Area -->

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