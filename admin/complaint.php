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
        .dash-heading {
            font-size: 1.5rem;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="admin-dashboard.css?v=3">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
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
                    <div class="container-fluid">
                        <div class="card mt-4 shadow-sm">
                            <div class="card-header">
                                <h1 class="dash-heading">Pending Complaints</h1>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                       $query = "SELECT * FROM `complaint` WHERE status='pending' ORDER BY FIELD(urgency, 'high', 'medium', 'low')";
                                       $result = mysqli_query($con,$query);
                                    ?>
                                    <table class="table table-striped table-hover table-bordered border-secondary text-center" id="datatableid1">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reference No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Urgency</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                while($row=mysqli_fetch_assoc($result)) {
                                                    $ID = $row['id'];
                                                    $RefNo = $row['refno'];
                                                    $UserName = $row['name'];
                                                    $Subject = $row['subject'];
                                                    $Urgency = $row['urgency'];
                                                    $RegDate = $row['date'];
                                                    $Status = $row['status'];
                                            ?>
                                            <tr>
                                                <td><?php echo $RefNo ?></td>
                                                <td><?php echo $UserName ?></td>
                                                <td><?php echo $Subject ?></td>
                                                <td><?php echo $Urgency ?></td>
                                                <td><?php echo $RegDate ?></td>
                                                <td><?php echo $Status ?></td>
                                                <td>
                                                    <a href="view-complaint.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary">VIEW</a>
                                                    <a href="complaint-delete.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger">REMOVE</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-4 shadow-sm">
                            <div class="card-header">
                                <h1 class="dash-heading">InProgress Complaints</h1>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                       $query = "SELECT * FROM `view_cmp` WHERE status='inprogress' ORDER BY FIELD(urgency, 'high', 'medium', 'low')";
                                       $result = mysqli_query($con,$query);
                                    ?>
                                    <table class="table table-striped table-hover table-bordered border-secondary text-center" id="datatableid2">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reference No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Urgency</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Assigned Engineer</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                while($row=mysqli_fetch_assoc($result)) {
                                                    $ID = $row['cmp_id'];
                                                    $RefNo = $row['refno'];
                                                    $UserName = $row['name'];
                                                    $Subject = $row['subject'];
                                                    $Urgency = $row['urgency'];
                                                    $RegDate = $row['date'];
                                                    $Status = $row['status'];
                                                    $engi = $row['engineer'];
                                            ?>
                                            <tr>
                                                <td><?php echo $RefNo ?></td>
                                                <td><?php echo $UserName ?></td>
                                                <td><?php echo $Subject ?></td>
                                                <td><?php echo $Urgency ?></td>
                                                <td><?php echo $RegDate ?></td>
                                                <td><?php echo $engi ?></td>
                                                <td><?php echo $Status ?></td>
                                                <td>
                                                    <a href="complaint-delete.php?id=<?= $row['cmp_id']; ?>" class="btn btn-outline-danger">REMOVE</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-4 shadow-sm">
                            <div class="card-header">
                                <h1 class="dash-heading">Completed Complaints</h1>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                       $query = "SELECT * FROM `view_cmp` WHERE status='completed' ORDER BY FIELD(urgency, 'high', 'medium', 'low')";
                                       $result = mysqli_query($con,$query);
                                    ?>
                                    <table class="table table-striped table-hover table-bordered border-secondary text-center" id="datatableid3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reference No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Urgency</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Assigned Engineer</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                while($row=mysqli_fetch_assoc($result)) {
                                                    $ID = $row['cmp_id'];
                                                    $RefNo = $row['refno'];
                                                    $UserName = $row['name'];
                                                    $Subject = $row['subject'];
                                                    $Urgency = $row['urgency'];
                                                    $RegDate = $row['date'];
                                                    $Status = $row['status'];
                                                    $engi = $row['engineer'];

                                            ?>
                                            <tr>
                                                <td><?php echo $RefNo ?></td>
                                                <td><?php echo $UserName ?></td>
                                                <td><?php echo $Subject ?></td>
                                                <td><?php echo $Urgency ?></td>
                                                <td><?php echo $RegDate ?></td>
                                                <td><?php echo $engi ?></td>
                                                <td><?php echo $Status ?></td>
                                                <td>
                                                    <a href="complaint-delete.php?id=<?= $row['cmp_id']; ?>" class="btn btn-outline-danger">REMOVE</a>                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?> 
                                        </tbody>
                                    </table>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#datatableid1');
        new DataTable('#datatableid2');
        new DataTable('#datatableid3');
    </script>

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
</body>
</html>