<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Engineer | Home</title>

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
        .div_data{
            width: 200px;
            height: 35px;
            position: relative;
            font-size: 17px;
            padding-top: 5px;
        }
        .div_data span{
            color:#fff;;
        }
        .blue{background: #7d2ae8;}
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
                <li><a class="active" href="engineer-dashboard.php">
                    <i class="uil uil-desktop"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-user"></i>
                    <span class="link-name">My Profile</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-inbox"></i>
                    <span class="link-name">Inbox</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Work History</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../index.php">
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
                        <span class="user-name">demo engineer</span>
                        <span class="user-email">demo.engineer@gmail.com</span>
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
                            <h1 class="dash-heading">Dashboard</h1>
                        </div>
                    </div>
                    <section class="custom-grid">
                        <div class="custom-container">
                            <div class="custom-icon-container1">
                                <i class="uil uil-file-edit-alt custom-svg-icon"></i>
                            </div>
                            <div class="custom-text">
                                <span class="custom-number">
                                    0
                                </span>
                                <span class="custom-description">Pending Work</span>
                            </div>
                        </div>

                        <div class="custom-container">
                            <div class="custom-icon-container2">
                                <i class="uil uil-file-edit-alt custom-svg-icon2"></i>
                            </div>
                            <div class="custom-text">
                                <span class="custom-number">
                                0
                                </span>
                                <span class="custom-description">Completed Work</span>
                            </div>
                        </div>
                    </section>
                    <div class="container" style="margin-top: 50px; padding-left: 0;">
                        <div class="custom-flex-container mb-3">
                            <div class="dash-container">
                                <h1 class="dash-heading">Notifications</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div>No Notifications</div>
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

