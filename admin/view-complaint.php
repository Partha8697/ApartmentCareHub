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
    <link rel="stylesheet" href="admin-dashboard.css?v=3">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
                <li><a href="admin-profile.php">
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
                <li><a class="active" href="complaint.php">
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
                            <h1 class="dash-heading">Complaint Details</h1>
                        </div>
                    </div>
                    <div class="container">
                    <form>
                        <?php
                            $ID = $_GET['id'];
                            $query = "SELECT * FROM `complaint` WHERE id = '$ID' LIMIT 1";
                            $result = mysqli_query($con,$query);
                        ?>
                        <?php 
                            while($row=mysqli_fetch_assoc($result)) {
                                $ID = $row['id'];
                                $profile_id = $row['profile_id'];
                                $Name = $row['name'];
                                $Email = $row['email'];
                                $refno = $row['refno'];
                                $contact = $row['contactno'];
                                $apartment = $row['apartmentno'];
                                $subject = $row['subject'];
                                $complaint = $row['complaint'];
                                $urgency = $row['urgency'];
                                $date = $row['date'];
                                $status = $row['status'];
                            }
                        ?>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $ID; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Profile ID</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $profile_id; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $Name; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $Email; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Reference No</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $refno; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Contact No</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $contact; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Apartment No</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $apartment; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $subject; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Complaint</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $complaint; ?>">
                            </div>
                        </div>
                        <div class="row ">
                            <label for="" class="col-sm-2 col-form-label">Urgency</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $urgency; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $date; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $status; ?>">
                            </div>
                        </div>
                        <a href="forward.php?id=<?= $ID; ?>" class="btn btn-danger">TAKE ACTION</a>
                        <a href="complaint.php" class="btn btn-primary">BACK</a>
                    </form>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatableid');
    </script>
</body>
</html>