<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css?v=27">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Main Menu</title>
</head>
<body>
    <!--Nav-bar start-->
    <header class="header">
        <nav class="nav-bar"> 
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="index.php">ComplaintBooking.com</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="index.php">LOGO</a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php" class="link1">Home</a></li>
                    <li><a href="admin/admin-dashboard.php">Admin</a></li>
                    <li><a href="Engineer\engineer-dashboard.php">Engineer</a></li>
                    <li><a href="signup.php">User Registration</a></li>
                </ul>
            </div>

            <button type='button' class="button" id="form-open">Login</button>
        </nav>
    </header>
    <!--Nav-bar End -->

    <!--Popup Container start-->
    <div class="popup-container">
        <div class="popup">
            
            <button type="reset" class="form-close close-btn"><i class='bx bx-x'></i></button>

            <div class="form login-form">
                <form>
                  <h2>USER LOGIN</h2> 

                  <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required> 
                    <i class="fas fa-envelope email"></i>
                  </div>
                  <div class="input-box">
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-lock password"></i>
                    <i class="uil uil-eye-slash pass-hide"></i>
                  </div>

                  <div class="input-box captch-box">
                      <input type="text" name="captcha" value="X    5    H    7    i    o" disabled>
                      <i class="fas fa-redo-alt refresh-button"></i>
                  </div>
                  <div class="input-box captch-input">
                    <input type="text" name="captcha-check" placeholder="Enter captcha" required>
                  </div>
          
                  <div class="option-field">
                    <a href="#" class="forgot-pass">Forgot password?</a>
                  </div>

                  <button class="login-btn" type="button" name="login" onclick="window.location.href='home.php'">Login Now</button>
      
                  <div class="login-signup">Don't have an account? <a href="signup.php" id="signup">Signup</a></div>
                </form> 
            </div> 
        </div>
    </div>
    <!--Popup Container end-->

    <!--Home Section start-->
    <div class="home">
      <div class="row container">
        <div class="column" >
          <h2>How can we help you ?</h2>
          <p>Welcome to Online Complaint Booking System. Register/Login to raise Complaint to book a Service</p>
          <a href="javascript:void(0)" class="help-section">How to Complaint? Click here to see the guidelines</a>
        </div>
        <div class="column">
          <img src="hero-banner.png" alt="homeImg" class="home-img" />
        </div>
      </div>
    </div>
    <!--Home Section end-->
    
    <footer class="footer">
    <script src="script.js"></script> 
    <script src="passbutton.js?v=4"></script> 
    <script>
        $(document).ready(function () {
            $('.help-section').click(function () { 
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