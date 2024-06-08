<?php require_once "engineer-controller.php"; 
require_once "../Captcha/generate-captcha.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineer Login</title>

    <link rel="stylesheet" href="style.css?v=19">
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
    </style>
</head>
<body>
    <div class="main">
        <a href="../index.php" class="back-btn">Back to Portal</a>

        <div class="container">
            <form action="engineer-login.php" method="post" novalidate>
                <h2>Engineer Login</h2>
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
                
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>