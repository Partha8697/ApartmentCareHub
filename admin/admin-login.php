<?php require_once "process-admin-login.php"; 
require_once "../Captcha/generate-captcha.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        h2{
            text-align: center;
            color: #660066;
        }
        .forgot-pass {
            font-weight: bold;
            color: #71c418;
            margin-top: 5px;
            text-decoration: none;
            font-size: 13px;
        }
    </style>

    <link rel="stylesheet" href="style.css?v=21">
</head>
<body>
    <div class="main">
        <a href="../index.php" class="back-btn">Back to Portal</a>
        <div class="container">
            <form action="admin-login.php" method="post" novalidate>
                <h2>Admin Login</h2>
                <span class="error" style="text-align: center;"><?php echo implode(" ",$errors);?></span>

                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email" placeholder="Email">
                <span class="error"><?php echo implode(" ",$emailErr);?></span>
                
                <label for="password">Enter your password</label>
                <input type="password" id="password" name="password" placeholder="Password">
                <span class="error"> <?php echo implode(" ",$passwordErr);?></span>
                
                <label for="captcha">Captcha Code</label>
                <input type="text" class="captcha" id="captcha" name="captcha" value="<?php echo $rand; ?>" disabled>
                <span class="error"></span>
                
                <label for="captcha-check">Enter the Captcha</label>
                <input type="text" id="captcha-check" name="captcha-check" placeholder="Captche Code">
                <span class="error"> <?php echo implode(" ",$captchaErr);?></span>

                <a href="admin-forgot-pass.php" class="forgot-pass">Forgot password?</a>
                
                <button type="submit" name="login">Login</button>
            </form>
            <div class="ear-l"></div>
            <div class="ear-r"></div>
            <div class="panda-face">
                <div class="blush-l"></div>
                <div class="blush-r"></div>
                <div class="eye-l">
                    <div class="eyeball-l"></div>
                </div>
                <div class="eye-r">
                    <div class="eyeball-r"></div>
                </div>
                <div class="nose"></div>
                <div class="mouth"></div>
            </div>
            <div class="hand-l"></div>
            <div class="hand-r"></div>
            <div class="paw-l"></div>
            <div class="paw-r"></div>
        </div>
    </div>

    <script  src="script.js?v=12"></script>
</body>
</html>