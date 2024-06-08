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
        .error {
            color: red;
            font-size: 12px;
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
                            <h1 class="dash-heading">Forward Complaint</h1>
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <div class="card mt-4 shadow-sm">
                            <div class="card-body">
                                <form class="row g-3" action="" method="post">
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
                                            $Urgency = $row['urgency'];
                                            $complaint = $row['complaint'];
                                            $date = $row['date'];
                                        }
                                    ?>
                                    <input type="hidden" name="id" value="<?php echo $ID; ?>">
                                    <input type="hidden" name="name" value="<?php echo $Name; ?>">
                                    <input type="hidden" name="email" value="<?php echo $Email; ?>">
                                    <input type="hidden" name="refno" value="<?php echo $refno; ?>">
                                    <input type="hidden" name="contact" value="<?php echo $contact; ?>">
                                    <input type="hidden" name="apart" value="<?php echo $apartment; ?>">
                                    <input type="hidden" name="sub" value="<?php echo $subject; ?>">
                                    <input type="hidden" name="cmp" value="<?php echo $complaint; ?>">
                                    <input type="hidden" name="urgency" value="<?php echo $Urgency; ?>">
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">

                                    <select class="form-select" name="engi" aria-label="Default select example">
                                        <option selected>Select Engineer</option>
                                        <?php
                                            $sql = "SELECT * FROM `engineer`";
                                            $res = mysqli_query($con,$sql);
                                        ?>
                                        <?php 
                                            while($arr=mysqli_fetch_assoc($res)) {
                                                $engiID = $arr['id'];
                                                $engiName = $arr['name'];
                                                $engiEmail = $arr['email'];
                                        ?>
                                            <option value="<?php echo $engiName; ?>"><?php echo $engiName; ?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>            
                                    <span class="error"><?php echo implode(" ",$engiErr);?></span>
                                    <div class="col-12 mb-3 text-end">
                                        <button type="submit" name="forward" class="btn btn-primary">Assign</button>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatableid');
    </script>
</body>
</html>