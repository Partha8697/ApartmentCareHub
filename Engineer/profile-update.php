<?php require_once "engineer-controller.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false) {
    $sql = "SELECT * FROM `engineer` WHERE email = '$email'";
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
    <link rel="stylesheet" href="../admin/admin-dashboard.css?v=5">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../logo.png" alt="">
            </div>

            <span class="logo_name">Engineer Panel</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="engineer-dashboard.php">
                    <i class="uil uil-desktop"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a class="active" href="profile.php">
                    <i class="uil uil-user"></i>
                    <span class="link-name">My Profile</span>
                </a></li>
                <li><a href="inbox.php">
                    <i class="uil uil-inbox"></i>
                    <span class="link-name">Inbox</span>
                </a></li>
                <li><a href="history.php">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Work History</span>
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
                    <div class="container-fluid px-4">
                        <div class="card mt-4 shadow-sm">
                            <div class="card-header">
                                <h4 class="mb-0 dash-heading">Update Profile
                                    <a href="profile.php" class="btn btn-danger float-end">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form class="row g-3 p-3" method="post">
                                    <?php
                                        $adminID = $_GET['id'];
                                        $query = "SELECT * FROM `engineer` WHERE id = '$adminID' LIMIT 1";
                                        $result = mysqli_query($con,$query);
                                    ?>
                                    <?php 
                                        while($row=mysqli_fetch_assoc($result)) {
                                            $adminID = $row['id'];
                                            $adminName = $row['name'];
                                            $adminEmail = $row['email'];
                                            $adminContact = $row['contact'];
                                            $role = $row['role'];
                                        }
                                    ?>
                                    <input type="hidden" name="id" value="<?php echo $adminID; ?>">
                                    <div class="col-12">
                                        <label for="inputname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $adminName; ?>" placeholder="Full Name">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputemail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $adminEmail; ?>" placeholder="Email" disabled>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputcontact" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" name="contact" value="<?php echo $adminContact; ?>" placeholder="Enter Your Mobile No.">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputrole" class="form-label">Role</label>
                                        <input type="text" class="form-control" name="role" value="<?php echo $role; ?>" placeholder="Enter Your Mobile No." disabled>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" name="update-profile" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
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
</body>
</html>

