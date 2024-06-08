<?php require_once "process-signup.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false) {
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified") {
            if($code != 0) {
                header('Location: user-reset-code.php');
            }
        } else {
            header('Location: user-otp.php');
        }
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="user-home.css?v=12">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="logo.png" alt="">
            </div>

            <span class="logo_name">CBS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="home.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="user-profile.php">
                    <i class="uil uil-user"></i>
                    <span class="link-name">My Profile</span>
                </a></li>
                <li><a href="add-complaint.php">
                    <i class="uil uil-file-plus-alt"></i>
                    <span class="link-name">Add Complaint</span>
                </a></li>
                <li><a class="active" href="track-status.php">
                    <i class="uil uil-file-search-alt"></i>
                    <span class="link-name">Track Status</span>
                </a></li>
                <li><a href="complaint-history.php">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Complaint History</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="javascript:void(0)" class="help">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Need Help</span>
                </a></li>
                <li><a href="logout.php">
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
                        <img src="user.png" alt="user profile photo">
                    </span>
                </button>
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <main class="custom-main">
                    <div class="custom-flex-container">
                        <div class="dash-container">
                            <h1 class="dash-heading">Current Status of Your Complaint</h1>
                        </div>
                    </div>
                    <div class="container-fluid px-4">
                        <div class="card mt-4 shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php
                                    $query = "SELECT * FROM `complaint` WHERE email = '$fetch_info[email]' AND status IN ('inprogress', 'pending')";
                                    
                                    $result = mysqli_query($con,$query);
                                    ?>
                                    <table class="table table-hover table-bordered text-center" id="datatableid" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reference Number</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Complaint</th>
                                                <!-- <th scope="col">Assigned Engineer</th> -->
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(mysqli_num_rows($result) > 0) {
                                                    while($row=mysqli_fetch_assoc($result)) {
                                                        $refno = $row['refno'];
                                                        $sub = $row['subject'];
                                                        // $engi = $row['engineer'];
                                                        $cmp = $row['complaint'];
                                                        $status = $row['status'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $refno ?></td>
                                                    <td><?php echo $sub ?></td>
                                                    <td><?php echo $cmp ?></td>
                                                    <td><?php echo $status ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                else {
                                                    ?>
                                                <tr>
                                                    <td colspan="6">No records found.</td>
                                                </tr>
                                                <?php
                                                }
                                                ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <a href="home.php" class="btn btn-danger float-start">BACK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.help').click(function () { 
              Swal.fire({
                title: "Guidelines For User",
                html:
                    '1. If you want to place complaint first of all register yourself in \'User Registration\''+'<br>'+'<br>'+
                    '2. If you are a registered user then Login using your Email and password'+'<br>'+'<br>'+
                    '3. Now you can setup Your Profile through \'My Profile\' section'+'<br>'+'<br>'+
                    '4. you can complain and book a service by clicking the \'Add Complaint\' button'+'<br>'+'<br>'+
                    '5. After submitting your complaint and wait for response on it.'+'<br>'+'<br>'+
                    '6. You can see your complaint status on your dashboard through \'Track Status\''+'<br>'+'<br>'+
                    '7. You will be emailed when your complaint process begins'+'<br>'+'<br>'+
                    '8. If you want to logout there is Logout button at bottom-left corner.',

                customClass: {
                    popup: 'custom-popup-class',
                }
              });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>