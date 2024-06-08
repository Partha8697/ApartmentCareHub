<?php require_once "process-signup.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link rel="stylesheet" href="register.css?v=10">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <style>
        .back-btn {
            text-decoration: none;
            float: right;
            color: linear-gradient(-45deg, #660066 0%, #b84dff 100%);
            font-weight: bold;
            font-size: 18px;
            padding-top: 30px;
            padding-right: 70px;
        }
    </style>
</head>
<body>
<div class="form-container">
     <a href="index.php" class="back-btn">Back to Portal</a>
     <div class="form signup-form">
         <form action="signup.php" method="post" novalidate>
             <h2>USER REGISTRATION</h2> 
             <span class="error"><?php echo implode(" ",$errors);?></span>
                  
             <div class="input-box">
                 <input type="text" name="name" placeholder="Full name">
                 <i class="fas fa-user user"></i>
                 <span class="error"><?php echo implode(" ",$nameErr);?></span>
             </div>
                  
             <div class="input-box">
                 <input type="email" name="email" placeholder="Email">
                 <i class="fas fa-envelope email"></i>
                 <span class="error"><?php echo implode(" ",$emailErr);?></span>
             </div>
             <div class="input-box">
                 <input type="password" name="password" placeholder="Password">
                 <i class="fas fa-lock password"></i>
                 <i class="uil uil-eye-slash pass-hide"></i>
                 <span class="error"> <?php echo implode(" ",$passwordErr);?></span>
             </div>
                  
             <div class="input-box">
                 <input type="password" name="cpassword" placeholder="Confirm Password">
                 <i class="fas fa-lock confirm-pass"></i>
                 <i class="uil uil-eye-slash pass-hide"></i>
                 <span class="error"><?php echo implode(" ",$cpasswordErr);?></span>
             </div>
                  

             <button class="signup-btn" type="submit" name="signup">Sign Up</button>
      
             <div class="login-signup">Already a member? <a href="index.php" id="signup">Login here</a></div>
         </form> 
     </div> 
</div>

<script src="passbutton.js?v=10"></script> 

</body>
</html>