<?php
    require "connection.php";
    require "session.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $name = "";
    $email = "";
    $nameErr = array();
    $emailErr = array(); 
    $passwordErr = array();
    $cpasswordErr = array();
    $contactErr = array();
    $apartmentErr = array();
    $errors = array();
    $opErr = array();
    $npErr = array();
    $rpErr = array();

    function sendMail($email, $code) {
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        require 'PHPMailer/Exception.php';
    
        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'complaint.booking.system@gmail.com';                     
            $mail->Password   = 'jqpk uopi utht dwyi';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                   
        
            $mail->setFrom('complaint.booking.system@gmail.com', 'ComplaintBooking');
            $mail->addAddress($email);   
        
            $mail->isHTML(true);  
            $mail->Subject = 'OTP for verification';                             
            $mail->Body    = "Your verification code is $code for registration";
            $mail->AltBody = "complaint.booking.system@gmail.com";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendFeedback($email, $msg, $sender) {
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        require 'PHPMailer/Exception.php';
    
        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'complaint.booking.system@gmail.com';                     
            $mail->Password   = 'jqpk uopi utht dwyi';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                   
        
            $mail->setFrom('complaint.booking.system@gmail.com', 'ComplaintBooking');
            $mail->addAddress($email);   
        
            $mail->isHTML(true);  
            $mail->Subject = "Feedback from $sender";                             
            $mail->Body    = "$msg from $sender";
            $mail->AltBody = "complaint.booking.system@gmail.com";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    if(isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        if(empty($name)) {
            $nameErr = array("*Name is required");
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {
                $nameErr = array("*Only letters and white space allowed");
            }
        }

        if(empty($email)) {
            $emailErr = array("*Email is required");
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = array("*Invalid email format");
            }
        }
        
        if(empty($password)) {
            $passwordErr = array("*Password is required");
        } else {
            if (strlen($_POST["password"]) < 8) {
                $passwordErr = array("*Password must be at least 8 characters");
            } elseif (! preg_match("/[a-z]/i", $_POST["password"])) {
                $passwordErr = array("*Password must contain at least one letter");
            } elseif (! preg_match("/[0-9]/", $_POST["password"])) {
                $passwordErr = array("*Password must contain at least one number");
            }
        }

        if(empty($cpassword)) {
            $cpasswordErr = array("*This field cannot remain empty");
        } else {
            if ($password !== $cpassword) {
                $cpasswordErr = array("*Confirm password not matched!");
            }
        }

        $email_check = "SELECT * FROM `user` WHERE email = '$email'";
        $res = mysqli_query($con, $email_check); 
        if($res) {
            if(mysqli_num_rows($res) > 0){
                $emailErr = array("*Email that you have entered is already exist!");
            }
            if(count($nameErr) === 0 && count($emailErr) === 0 && count($passwordErr) === 0 && count($cpasswordErr) === 0 ) {
                $code = rand(999999, 111111);
                $status = "notverified";
                $insert_data = "INSERT INTO user (name, email, password, code, status) values('$name', '$email', '$password', '$code', '$status')";
                $data_check = mysqli_query($con, $insert_data);
                if($data_check) {
                    if(sendMail($email, $code)){
                        $info = "We've sent a verification code to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: user-otp.php');
                        exit();
                    }else{
                        $errors = array("Failed while sending code!");
                    }
                }
                else {
                    echo "<script>
                            alert('Failed while inserting data into database!');
                          </script>";
                }
            }
        }
        else {
            echo "
                     <script>
                        alert('Cannot Run Query');
                        window.location.href='signup.php';
                     </script>
            ";
        }
    }

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE user SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['user_loggedin'] = true;
                header('location: home.php');
                exit();
            }else{
                $errors = array("Failed while updating code!");
            }
        }else{
            $errors = array("You've entered incorrect code!");
        }
    }

    if(isset($_POST['login'])){
        $errCount = 0;
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $captcha = str_replace('   ', '', mysqli_real_escape_string($con, $_SESSION['captcha']));;
        $captchacheck = mysqli_real_escape_string($con, $_POST['captcha-check']);

        if(empty($email)) {
            $errCount++;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errCount++;
            }
        }

        if(empty($password)) {
            $errCount++;
        }

        if(empty($captchacheck)) {
            $errCount++;
        } else {
            if ($captcha  !== $captchacheck) {
                $errCount++;
            }
        }

        if ($errCount == 0) {
            $check_email = "SELECT * FROM user WHERE email = '$email'";
            $res = mysqli_query($con, $check_email);
            if(mysqli_num_rows($res) > 0){
                $fetch = mysqli_fetch_assoc($res);
                $fetch_pass = $fetch['password'];
                if($password == $fetch_pass){
                    $_SESSION['email'] = $email;
                    $status = $fetch['status'];
                    if($status == 'verified'){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $_SESSION['user_loggedin'] = true;
                        header('location: home.php');
                    }else{
                        $info = "It's look like you haven't still verify your email - $email";
                        $_SESSION['info'] = $info;
                        header('location: user-otp.php');
                    }
                } else{
                    echo "<script>
                            alert('Incorrect email or password!');
                        </script>";
                }
            } else{
                echo "<script>
                        alert('It's look like you're not yet a member! Click on User Registration to signup.');
                    </script>";
            }
        }  
    }
    
    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);

        if(empty($email)) {
            $errors['email'] = "Please Enter Your Email";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "*Invalid email format";
            } else {
                $check_email = "SELECT * FROM `user` WHERE email='$email'";
                $run_sql = mysqli_query($con, $check_email);
                if(mysqli_num_rows($run_sql) > 0){
                    $code = rand(999999, 111111);
                    $insert_code = "UPDATE `user` SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($con, $insert_code);
                    if($run_query){
                        if(sendMail($email, $code)){
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            header('location: user-reset-code.php');
                            exit();
                        }else{
                            $errors['otp-error'] = "Failed while sending code!";
                        }
                    }else{
                        $errors['db-error'] = "Something went wrong!";
                    }
                }else{
                    $errors['email'] = "Its look like you are not a registered user";
                }
            }
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM `user` WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: user-new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

        //if user click change password button
    if(isset($_POST['update-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        if(empty($password)) {
            $errors['password'] = "Please Enter a New Password";
        } else {
            if (strlen($_POST["password"]) < 8) {
                $errors['password'] = "Password must be at least 8 characters";
            } elseif (! preg_match("/[a-z]/i", $_POST["password"])) {
                $errors['password'] = "Password must contain at least one letter";
            } elseif (! preg_match("/[0-9]/", $_POST["password"])) {
                $errors['password'] = "Password must contain at least one number";
            } elseif(empty($cpassword)) {
                $errors['password'] = "Please Repeat the Password";
            }
        }

        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $update_pass = "UPDATE `user` SET code = $code, password = '$password' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: user-password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    if(isset($_POST['login-now'])){
        header('Location: index.php');
    }

    if(isset($_POST['update-profile'])){
        
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $apartment = mysqli_real_escape_string($con, $_POST['apartment']);
        $countErr = 0;

        if(empty($name)) {
            $nameErr = array("*Name is required");
            $countErr++;
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {
                $nameErr = array("*Only letters and white space allowed");
                $countErr++;
            }
        }

        if(empty($contact)) {
            $contactErr = array("*Please enter a contact number to update");
            $countErr++;
        } else {
            if (!preg_match("/^[1-9]\d{9}$/",$_POST['contact'])) {
                $contactErr = array("*Invalid Contact Number");
                $countErr++;
            }
        }

        if(empty($apartment)) {
            $apartmentErr = array("*Please enter your apartment number to update");
            $countErr++;
        } else {
            if (!preg_match('/^[A-Z]\d{3}$/', $_POST['apartment'])) {
                $apartmentErr = array("Please a Valid Apartment Number such as A145, B123, etc.");
                $countErr++;
            }
        }

        if($countErr == 0) {
            $insert_data = "UPDATE `user` SET `name`='$name',`contact`='$contact',`apartmentno`='$apartment' WHERE id = '$id'";
            $data_check = mysqli_query($con, $insert_data);

            if($data_check) {
                $_SESSION['message'] = "Your data has been updated successfully";
                header('location: user-profile.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                    </script>";
            }
        }
    }

    if(isset($_POST['change-password'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $op = mysqli_real_escape_string($con, $_POST['op']);
        $np = mysqli_real_escape_string($con, $_POST['np']);
        $rp = mysqli_real_escape_string($con, $_POST['rp']);

        if(empty($op)) {
            $opErr = array("*Old Password is required");
        }

        if(empty($np)) {
            $npErr = array("*New Password is required");
        } else {
            if (strlen($_POST['np']) < 8) {
                $npErr = array("*Password must be at least 8 characters");
            } elseif (! preg_match("/[a-z]/i", $_POST['np'])) {
                $npErr = array("*Password must contain at least one letter");
            } elseif (! preg_match("/[0-9]/", $_POST['np'])) {
                $npErr = array("*Password must contain at least one number");
            }
        }

        if(empty($rp)) {
            $rpErr = array("*This field cannot remain empty");
        } else {
            if ($np !== $rp) {
                $rpErr = array("*Repeat Password not matched!");
            } else {
                $sql = "SELECT * FROM user WHERE id='$id'";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    $fetch = mysqli_fetch_assoc($res);
                    $fetch_pass = $fetch['password'];
                    if($op == $fetch_pass){
                        $insert_data = "UPDATE `user` SET password = '$np' WHERE id = '$id'";
                        $data_check = mysqli_query($con, $insert_data);
                        if($data_check) {
                            $_SESSION['message'] = "Your Password has been changed successfully";
                            header('location: user-profile.php');
                        }
                        else {
                            echo "<script>
                                    alert('Failed while inserting data into database!');
                                </script>";
                        }
                    }
                    else {
                        $_SESSION['fail'] = "Old Password is not correct!";
                        header('location: change-password.php');
                    }
                }
                else {
                    echo "<script>
                            alert('Something Went Wrong!');
                        </script>";
                }
            }
        }    
    }

    if(isset($_POST['send'])){
        $recipient = "complaint.booking.system@gmail.com";
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $sender = mysqli_real_escape_string($con, $_POST['email']);
        $msg = mysqli_real_escape_string($con, $_POST['msg']);
        $countErr = 0;

        if(empty($name)) {
            echo "<script>
                    alert('Please enter a name');
                </script>";
            $countErr++;
        }

        if(empty($sender)) {
            echo "<script>
                    alert('Please enter a email address');
                </script>";
            $countErr++;
        } else {
            if (!filter_var($sender, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                    alert('Invalid email address');
                </script>";
                $countErr++;
            }
        }

        if(empty($msg)) {
            echo "<script>
                    alert('Please enter a message to continue');
                </script>";
                $countErr++;
        }

        if($countErr === 0) {
            if(sendFeedback($recipient, $msg, $sender)) {
                echo "<script>
                    alert('Your feedback has been sent successfully');
                </script>";
            } 
        }
    }
?>