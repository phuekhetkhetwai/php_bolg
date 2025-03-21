<?php
    include "../_actions/vendor/autoload.php";

    use Helpers\HTTP;
    use Helpers\Auth;
    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    $auth = Auth::check();
    
    if(!$auth|| $auth->role_id != 2) {
        HTTP::redirect("admin/login.php", "auth=fail");
        exit();
    }

    $table = new UsersTable(new MySQL());

    if(isset($_POST["search"])) {
        setcookie("search",$_POST["search"], time() + (86400 * 30), "/");
      } else {
        if(empty($_GET["pageno"])) {
          unset($_COOKIE["search"]);
          setcookie("search", "" ,time() -1, "/");
        }
      }

    if(!empty($_GET["pageno"])){
        $pageno = $_GET["pageno"];
    }else{
        $pageno = 1;
    }

    $numofRecs = 2;
    $offset = ($pageno - 1) * $numofRecs;

    if(isset($_POST["search"]) || isset($_COOKIE["search"])){
        $searchval = isset($_POST["search"]) ? $_POST["search"] : $_COOKIE["search"];

        $users = $table->getUsersBySearch($searchval);

        $total_pages = ceil(count($users) / $numofRecs);
        $users = $table->getUsersByLimit($offset,$numofRecs,$searchval);

    }else{

        $users = $table->getUsers();

        $total_pages = ceil(count($users) / $numofRecs);
        $users = $table->getUsersByLimit($offset,$numofRecs);

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
                                        class="nav-link text-white p-3 mb-2 sidebarlinks"><i
                                            class="fa-solid fa-file me-3"></i>BlogList</a></li>
                                <li class="nav-item"><a href="user_lists.php"
                                        class="nav-link text-white p-3 mb-2 sidebarlinks" style="background-color: #333;box-shadow: 1px 0 5px #222;"><i
                                            class="fa-solid fa-users me-3"></i>UserList</a></li>
                            </ul>
                        </div>

                        <!-- end left side bar -->

                        <!-- start top side bar -->

                        <div class="col-lg-10 col-md-9 fixed-top ms-auto topnavbars">
                            <div class="row">
                                <div class="navbar navbar-expand navbar-light bg-white shadow">
                                    <!-- start quick search -->
                                    <form action="" method="post" class="me-auto">
                                        <div class="input-group">
                                            <input type="text" name="search" id="search"
                                                class="form-control border-0 shadow-none"
                                                placeholder="Search Something...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
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
                                                        class="fa-solid fa-user text-muted me-2"></i>User</a>
                                                <a href="../_actions/logout.php" class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket text-muted me-2"></i>Logout</a>
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
                        <a href="user_create.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus me-2"></i>New User</a>
                        <?php if(isset($_GET["update"])): ?>
                            <div class="alert alert-info ms-3">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Update Successfully.
                            </div>
                        <?php endif ?>

                        <?php if(isset($_GET["create"])): ?>
                            <div class="alert alert-info ms-3">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            Create Successfully.
                            </div>
                        <?php endif ?>
                        <div class="card">
                            <div class="card-body">
                                <table class="table tabel-striped">
                                    <tr>
                                        <th></th>
                                        <th>No.</th>
                                        <th style="width: 15%;">Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Change Role</th>
                                        <th>Actions</th>
                                    </tr>
                                    <?php $id=0 ?>
                                    <?php foreach($users as $user): ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo ++$id ?>.</td>
                                            <td><?php echo $user->name ?></td>
                                            <td><?php echo $user->email ?></td>
                                            <td>
                                                <?php if($user->role_id == 2) :?>
                                                    <div class="badge bg-success rounded-0"><?php echo $user->role ?></div>
                                                <?php else : ?>
                                                    <div class="badge bg-secondary rounded-0"><?php echo $user->role ?></div>
                                                <?php endif ?>
                                                
                                            </td>

                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a href="" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-arrows-rotate me-2"></i>Roles</a>

                                                    <div class="dropdown-menu">
                                                        <a href="../_actions/role.php?id=<?= $user->id ?>&role=1&pageno=<?= $pageno ?>" class="dropdown-item small">User</a>
                                                        <?php if(!($user->suspended)) :?>
                                                            <a href="../_actions/role.php?id=<?= $user->id ?>&role=2&pageno=<?= $pageno ?>" class="dropdown-item text-success small">Admin</a>
                                                        <?php endif ?>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if($user->role_id != 2) :?>
                                                    <?php if($user->suspended) :?>
                                                        <a href="../_actions/user_unsuspended.php?id=<?php echo $user->id?>&pageno=<?= $pageno ?>" class="btn btn-sm btn-warning">Ban</a>
                                                    <?php else : ?>
                                                        <a href="../_actions/user_suspended.php?id=<?php echo $user->id ?>&pageno=<?= $pageno ?>" class="btn btn-sm btn-outline-warning">Ban</a>
                                                    <?php endif ?>

                                                    <a href="../_actions/user_delete.php?id=<?php echo $user->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash-alt px-2"></i></a>
                                                <?php endif ?>    
                                            </td>

                                        </tr>
                                    <?php endforeach ?>    
                                </table>

                                <div class="float-end">
                                    <ul class="pagination">
                                        <li class="page-item"><a href="?pageno=1" class="page-link">first</a></li>
                                        <li class="page-item <?php echo $pageno <= 1 ? "disabled" : "" ?>"><a href="<?php echo $pageno <= 1 ? "#" : "?pageno=".($pageno-1) ?>" class="page-link"><i class="fa-solid fa-angles-left"></i></a></li>
                                        <li class="page-item"><a href="#" class="page-link"><?= $pageno ?></a></li>
                                        <li class="page-item <?php echo $pageno >= $total_pages ? "disabled" : "" ?>"><a href="<?php echo $pageno >= $total_pages ? "#" : "?pageno=".($pageno+1) ?>" class="page-link"><i class="fa-solid fa-angles-right"></i></a></li>
                                        <li class="page-item"><a href="?pageno=<?= $total_pages ?>" class="page-link">last</a></li>
                                    </ul>
                                </div>
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
                            <p>&copy; 2025 Copyright. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->

    <!-- bootstrap css1 js1 -->
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <!-- custom js -->
</body>

</html>