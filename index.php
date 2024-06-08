<?php require_once "process-signup.php"; 
require_once "Captcha/generate-captcha.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ApartmentCareHub</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="images/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--  font awesome icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom File's Link -->
    <link rel="stylesheet" href="style.css?v=16">
    <!-- <link rel="stylesheet" href="responsive-style.css"> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="75">
    <!-- Navbar section -->
    <header class="header_wrapper">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <a class="navbar-brand" href="#">
                    <img decoding="async" src="images/logo.png" class="img-fluid" alt="logo">
                </a>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav menu-navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/admin-login.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Engineer/engineer-login.php">Engineer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">User Resgistration</a>
                        </li>
                    </ul>
                </div>

                <button type="button" class="d-none d-lg-block main-btn login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
            </div>
        </nav>
    </header>
    <!-- Navbar section exit -->

    <!-- Button trigger modal -->
    

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-width modal-sm">
            <div class="modal-content">
                <div class="modal-header text-center border-0">
                    <h2 class="modal-title text-center w-100" id="loginModalLabel">USER LOGIN</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" action="index.php" method="post" novalidate>                    
                        <div class="form-floating mb-2">
                            <input type="email" id="email" name="email" class="form-control field" placeholder="Enter email address">
                            <label for="email">Email address</label>
                            <div class="invalid-feedback email-feedback">*Please provide a valid email</div>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" id="password" name="password" class="form-control field" placeholder="Enter password">
                            <label for="password">Password</label>
                            <div class="invalid-feedback">*Please provide a valid password</div>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">Security Code</span>
                            <input type="text" id="captcha" name="captcha" class="form-control captcha-box" value="<?php echo $rand; ?>" disabled>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" id="captcha-check" name="captcha-check" class="form-control field" placeholder="Enter captcha code">
                            <label for="captcha-check">Enter the Captcha</label>
                            <div class="invalid-feedback">*Please enter the captcha code</div>
                        </div>
                        <div class="form-text mb-2"><a href="user-forgot-pass.php" class="forgot-pass custom-text">Forgot password?</a></div>

                        <button type="submit" name="login" class="btn btn-primary sign-in-btn">Login Now</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="custom-text">Don't have an account? <a href="signup.php" class="signup">Signup</a></div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal exit -->

    <!-- Banner section -->
    <section id="home" class="banner_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-lg-1 order-1 banner-text">
                    <h1 class="text-uppercase position-relative">How can</h1>
                    <h1 class="text-uppercase">we help you?</h1>
                    <h5 class="text-uppercase">Welcome to Online Complaint Booking System. Register/Login to raise Complaint to book a Service</h5>
                    <div>
                        <a class="main-btn primary-btn help-section" href="javascript:void(0)">Read Me</a>
                        <button type="button" class="main-btn secondary-btn ms-4" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Login
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-2 order-2">
                    <div class="top-right-img d-flex align-items-center justify-content-center">
                        <img decoding="async" src="images/hero-banner.png" class="img-fluid banner-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner section exit -->

    <!-- Footer section -->
    <section id="contact" class="footer_wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <p class="footer-text text-center my-2">Copyright © 2023 All rights reserved | This website
                    is made by <a href="#">Partha Protim Sarkar</a>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer section exit -->

    <!-- Bootstrap 5 JS CDN Links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Custom Js Link -->
    <script src="main.js"></script>
    
    <script>
        const form = document.querySelector("form");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const captcha = document.getElementById("captcha");
        const captchacheck = document.getElementById("captcha-check");
        
        
        form.addEventListener("submit", (e) => {
            checkInputs();

            if (email.classList.contains("is-invalid") || password.classList.contains("is-invalid") || captchacheck.classList.contains("is-invalid")) {
                e.preventDefault();
            }
        });


        function checkInputs() {
            const fields = document.querySelectorAll(".field");

            for (const field of fields) {
                if(field.value == "") {
                    field.classList.add("is-invalid");
                    field.parentElement.classList.add("is-invalid");
                }

                if (fields[0].value != "") {
                    checkEmail();
                }
                
                fields[0].addEventListener("keyup", () => {
                    checkEmail();
                });

                if (fields[1].value != "") {
                    checkPassword();
                }

                fields[1].addEventListener("keyup", () => {
                    checkPassword();
                });

                if (fields[2].value != "") {
                    checkCaptcha();
                }

                field.addEventListener("keyup", () => {
                    if (field.value != "") {
                        field.classList.remove("is-invalid");
                        field.parentElement.classList.remove("is-invalid");
                        field.classList.add("is-valid");
                        field.parentElement.classList.add("is-valid");
                    }
                    else {
                        field.classList.add("is-invalid");
                        field.parentElement.classList.add("is-invalid");
                    }
                });
            }
        }

        function checkEmail() {
            const emailRegex = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,3})(\.[a-z]{2,3})?$/;

            if (!email.value.match(emailRegex)) {
                email.classList.add("is-invalid");
                email.parentElement.classList.add("is-invalid");
            }
            else {
                email.classList.remove("is-invalid");
                email.parentElement.classList.remove("is-invalid");
            }
            
        }

        function checkPassword() {
            const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;

            if (!password.value.match(passwordRegex)) {
                password.classList.add("is-invalid");
                password.parentElement.classList.add("is-invalid");
            }
            else {
                password.classList.remove("is-invalid");
                password.parentElement.classList.remove("is-invalid");
            }   
        }

        function checkCaptcha() {
            if (captcha.value.replace(/\s/g, '') != captchacheck.value) {
                captchacheck.classList.add("is-invalid");
                captchacheck.parentElement.classList.add("is-invalid");
            }
            else {
                captchacheck.classList.remove("is-invalid");
                captchacheck.parentElement.classList.remove("is-invalid");
            } 
        }
    </script>



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