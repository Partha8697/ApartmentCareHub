<?php require_once "process-admin-login.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false) {
    $sql = "SELECT * FROM `admin` WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
    }
} else {
    header('Location: index.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $fetch_info['name'] ?> | Home</title>

    <style>
        .nav-links li .active:before {
            content: "";
            position: absolute;
            left: -7px;
            height: 5px;
            width: 5px;
            border-radius: 50%;
            background-color: #9900ff;
        }
        .nav-links li .active i,
        .nav-links li .active .link-name{
            color: #9900ff;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="admin-dashboard.css?v=2">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../logo.png" alt="">
            </div>

            <span class="logo_name">Admin Panel</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin-dashboard.php">
                    <i class="uil uil-desktop"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a class="active" href="admin-profile.php">
                    <i class="uil uil-user"></i>
                    <span class="link-name">My Profile</span>
                </a></li>
                <li><a href="user.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">User</span>
                </a></li>
                <li><a href="manage-engineer.php">
                    <i class="uil uil-constructor"></i>
                    <span class="link-name">Engineer</span>
                </a></li>
                <li><a href="complaint.php">
                    <i class="uil uil-file-question-alt"></i>
                    <span class="link-name">Complaints</span>
                </a></li>
                <li><a href="manage-admin.php">
                    <i class="uil uil-setting"></i>
                    <span class="link-name">Manage Admin</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="user-menu">
                <button class="user-menu-button">
                    <span class="sr-only">User Menu</span>
                    <div class="user-info">
                        <span class="user-name"><?php echo $fetch_info['name'] ?></span>
                        <span class="user-email"><?php echo $fetch_info['email'] ?></span>
                    </div>
                    <span class="user-avatar">
                        <img src="../user.png" alt="user profile photo">
                    </span>
                </button>
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <main class="custom-main">
                    <div class="custom-flex-container">
                        <div class="dash-container">
                            <h1 class="dash-heading">My Profile</h1>
                        </div>
                    </div>
                    <div class="container" style="padding-left: 0;">
                        <div class="card" style="max-width: 800px;">
                            <div class="card-body">
                                <div class="row g-0" style="margin-right: 0; margin-left: 0;">
                                    <div class="col-md-4 d-flex align-items-center p-3">
                                        <img src="../user.png" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8 border-left d-flex align-items-center p-3">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $fetch_info['name']; ?></h5>
                                            <p class="card-text"><?php echo $fetch_info['email']; ?></p>
                                            <?php
                                                if($fetch_info['contact'] != NULL) {
                                                    ?>
                                                    <p class="card-text">+91 <?php echo $fetch_info['contact']; ?></p>
                                                    <?php
                                                }
                                            ?>
                                            <p class="card-text"><small class="text-muted">Joined since <?php echo $fetch_info['reg_date']; ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top">
                                <div class="float-end">
                                    <a href="admin-profile-update.php?id=<?= $fetch_info['id']; ?>" class="btn btn-primary">UPDATE PROFILE</a>
                                    <a href="admin-change-password.php?id=<?= $fetch_info['id']; ?>" class="btn btn-success">CHANGE PASSWORD</a>
                                    <a href="javascript:void(0)" class="delete_btn_ajax btn btn-danger">DELETE ACCOUNT</a>
                                </div>
                            </div> 
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
    <script>
        const body = document.querySelector("body"),
        sidebar = body.querySelector("nav"),
        sidebarToggle = body.querySelector(".sidebar-toggle");

        let getStatus = localStorage.getItem("status");
        if(getStatus && getStatus ==="close"){
            sidebar.classList.toggle("close");
        }

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if(sidebar.classList.contains("close")){
                localStorage.setItem("status", "close");
            }else{
                localStorage.setItem("status", "open");
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <?php if(isset($_SESSION['message']) != '') { 
        ?>
        <script>
            Swal.fire({
                title: 'Success!',
                icon: 'success',
                text: '<?php echo $_SESSION['message']; ?>',
                button: 'OK'
            })
        </script>
        <?php
        unset($_SESSION['message']);
    }
    ?>

    <script>
        $(document).ready(function () {
            $('.delete_btn_ajax').click(function (e) { 
                e.preventDefault();

                var deleteid = <?php echo $fetch_info['id']; ?>;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete your Account Permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "admin-profile-delete.php",
                            data: {
                                "delete_btn_set" : 1,
                                "delete_id" : deleteid
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: 'Your Account has been deleted successfully',
                                    button: 'OK'
                                }).then((result) => {
                                    window.location.href = "../logout.php";
                                })                          
                            }
                        })
                    }
                })
            });
        });
    </script>
</body>
</html>



