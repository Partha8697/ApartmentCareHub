<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Complaint</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="add-complaint.css?v=3">
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
                <li><a href="#">
                    <i class="uil uil-user"></i>
                    <span class="link-name">My Profile</span>
                </a></li>
                <li><a class="active" href="add-complaint.php">
                    <i class="uil uil-file-plus-alt"></i>
                    <span class="link-name">Add Complaint</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-file-search-alt"></i>
                    <span class="link-name">Track Status</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-history"></i>
                    <span class="link-name">Complaint History</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="javascript:void(0)" class="help">
                    <i class="uil uil-question-circle"></i>
                    <span class="link-name">Need Help</span>
                </a></li>
                <li><a href="index.php">
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
                        <span class="user-name">demo</span>
                        <span class="user-email">demo123@gmail.com</span>
                    </div>
                    <span class="user-avatar">
                        <img src="user.png" alt="user profile photo">
                    </span>
                </button>
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="wrapper">
                    <div class="title">
                        Complaint Registration Form
                    </div>
                    <form action="add-complaint.php" method="post" novalidate>
                        <input type="hidden" name="id" value="123">
                        <div class="inputfield">
                            <label>Refference Number</label>
                            <input type="number" name="refno" class="input input-style" value="2345675" readonly>
                        </div>  
                        <div class="inputfield">
                            <label>Full Name</label>
                            <input type="text" name="name" class="input input-style" value="demo" readonly>
                        </div>  
                        <div class="inputfield">
                            <label>Email</label>
                            <input type="email" name="email" class="input input-style" value="demo123@gmail.com" readonly>
                        </div>  
                        <div class="inputfield">
                            <label>Contact No.</label>
                            <input type="text" name="contact" class="input" placeholder="Your Phone Number">
                        </div> 
                        <div class="inputfield">
                            <label>Apartment No.</label>
                            <input type="text" name="apartment" class="input" placeholder="Your Apartment Number">
                        </div> 
                        <div class="inputfield">
                            <label>Complaint Type</label>
                            <input type="text" name="subject" class="input" placeholder="Subject">
                        </div> 
                        <div class="inputfield">
                            <label>Complaint Details</label>
                            <textarea class="textarea" name="complaint" placeholder="Your Complaint"></textarea>
                        </div> 
                        <div class="inputfield">
                            <label>Urgency</label>
                            <div class="custom_select">
                                <select name="urgency">
                                    <option value="">Select</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>                   
                        <div class="inputfield submit-btn">
                            <input type="submit" name="submit" value="Register" class="btn">
                        </div>
                    </form>
                </div>	
            </div>
        </div>
    </section>
    <script src="user-home.js?v=5"></script>
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
</body>
</html>