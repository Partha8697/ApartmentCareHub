<?php
    require "../connection.php";
    require "../session.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $nameErr = array();
    $emailErr = array(); 
    $passwordErr = array();
    $cpasswordErr = array();
    $captchaErr = array();
    $contactErr = array();
    $errors = array();
    $opErr = array();
    $npErr = array();
    $rpErr = array();
    $roleErr = array();
    $engiErr = array();

    function sendMailUser ($name, $email, $refno) {
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';
        require '../PHPMailer/Exception.php';
    
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
            $mail->Subject = 'Message From Complaint Booking System';                            
            $mail->Body    = "Hi $name, Smile, your complaint (Reference No.: $refno) has been assigned to an Engineer. Thank You for being patient. Track your complaint via our website.";
            $mail->AltBody = "complaint.booking.system@gmail.com";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendMail($name, $email) {
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';
        require '../PHPMailer/Exception.php';
    
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
            $mail->Subject = 'Message From Complaint Booking System';                            
            $mail->Body    = "Hi $name, You have assigned a new work. Please check the website for more information.";
            $mail->AltBody = "complaint.booking.system@gmail.com";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function sendOtp($email, $code) {
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


    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $captcha = str_replace('   ', '', mysqli_real_escape_string($con, $_SESSION['captcha']));;
        $captchacheck = mysqli_real_escape_string($con, $_POST['captcha-check']);

        if(empty($email)) {
            $emailErr = array("*Email is required");
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = array("*Invalid email format!");
            }
        }

        if(empty($password)) {
            $passwordErr = array("*Password is required");
        }

        if(empty($captchacheck)) {
            $captchaErr = array("*Please enter the captcha code");
        } else {
            if ($captcha  !== $captchacheck) {
                $errors = array("Invalid Captcha Value!");
            }
            else {
                $check_email = "SELECT * FROM `admin` WHERE email = '$email'";
                $res = mysqli_query($con, $check_email);
                if(mysqli_num_rows($res) > 0){
                    $fetch = mysqli_fetch_assoc($res);
                    $fetch_pass = $fetch['password'];
                    if($password == $fetch_pass){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: admin-dashboard.php');
                    }else{
                        $errors = array("Incorrect email or password!");
                    }
                }else{
                    $errors = array("It's look like you're not yet a admin!");
                }
            }
        }    
    }

    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);

        if(empty($email)) {
            $errors['email'] = "Please Enter Your Email";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            } else {
                $check_email = "SELECT * FROM `admin` WHERE email='$email'";
                $run_sql = mysqli_query($con, $check_email);
                if(mysqli_num_rows($run_sql) > 0){
                    $code = rand(999999, 111111);
                    $insert_code = "UPDATE `admin` SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($con, $insert_code);
                    if($run_query){
                        if(sendOtp($email, $code)){
                            $info = "We've sent a passwrod reset otp to your email - $email";
                            $_SESSION['info'] = $info;
                            $_SESSION['email'] = $email;
                            header('location: admin-reset-code.php');
                            exit();
                        }else{
                            $errors['email'] = "Failed while sending code!";
                        }
                    } else{
                        $errors['email'] = "Something went wrong!";
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
        $check_code = "SELECT * FROM `admin` WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: admin-new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

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
            $update_pass = "UPDATE `admin` SET code = $code, password = '$password' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: admin-password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    if(isset($_POST['login-now'])){
        header('Location: index.php');
    }

    if(isset($_POST['submit'])){
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

        $email_check = "SELECT * FROM `admin` WHERE email = '$email'";
        $res = mysqli_query($con, $email_check); 
        if($res) {
            if(mysqli_num_rows($res) > 0){
                $emailErr = array("*Email that you have entered is already exist!");
            }
            if(count($nameErr) === 0 && count($emailErr) === 0 && count($passwordErr) === 0 && count($cpasswordErr) === 0 ) {
                $insert_data = "INSERT INTO admin (name, email, password) values('$name', '$email', '$password')";
                $data_check = mysqli_query($con, $insert_data);
                if($data_check) {
                    $_SESSION['message'] = "New admin has been registered successfully";
                    header('location: manage-admin.php');
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
                        window.location.href='add-admin.php';
                     </script>
            ";
        }
    }

    if(isset($_POST['update'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
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

        if(empty($password)) {
            $passwordErr = array("*New Password is required");
            $countErr++;
        } else {
            if (strlen($_POST['password']) < 8) {
                $passwordErr = array("*Password must be at least 8 characters");
                $countErr++;
            } elseif (! preg_match("/[a-z]/i", $_POST['password'])) {
                $passwordErr = array("*Password must contain at least one letter");
                $countErr++;
            } elseif (! preg_match("/[0-9]/", $_POST['password'])) {
                $passwordErr = array("*Password must contain at least one number");
                $countErr++;
            }
        }

        if($countErr === 0) {
            $insert_data = "UPDATE `admin` SET name = '$name', password = '$password' WHERE id = '$id'";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "Admin data has been updated successfully";
                header('location: manage-admin.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                    </script>";
            }
        }
    }

    if(isset($_POST['update-user'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
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

        if(empty($password)) {
            $passwordErr = array("*New Password is required");
            $countErr++;
        } else {
            if (strlen($_POST['password']) < 8) {
                $passwordErr = array("*Password must be at least 8 characters");
                $countErr++;
            } elseif (! preg_match("/[a-z]/i", $_POST['password'])) {
                $passwordErr = array("*Password must contain at least one letter");
                $countErr++;
            } elseif (! preg_match("/[0-9]/", $_POST['password'])) {
                $passwordErr = array("*Password must contain at least one number");
                $countErr++;
            }
        }

        if($countErr === 0) {
            $insert_data = "UPDATE `user` SET name = '$name', password = '$password' WHERE id = '$id'";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "User data has been updated successfully";
                header('location: user.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                    </script>";
            }
        }
        
    }

    if(isset($_POST['update-profile-admin'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
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

        if($countErr === 0) {
            $insert_data = "UPDATE `admin` SET name = '$name', contact = '$contact' WHERE id = '$id'";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "Your data has been updated successfully";
                header('location: admin-profile.php');
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
                $sql = "SELECT * FROM admin WHERE id='$id'";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    $fetch = mysqli_fetch_assoc($res);
                    $fetch_pass = $fetch['password'];
                    if($op == $fetch_pass){
                        $insert_data = "UPDATE `admin` SET password = '$np' WHERE id = '$id'";
                        $data_check = mysqli_query($con, $insert_data);
                        if($data_check) {
                            $_SESSION['message'] = "Your Password has been changed successfully";
                            header('location: admin-profile.php');
                        }
                        else {
                            echo "<script>
                                    alert('Failed while inserting data into database!');
                                </script>";
                        }
                    }
                    else {
                        $_SESSION['fail'] = "Old Password is not correct!";
                        header('location: admin-change-password.php');
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

    if(isset($_POST['add'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        $role = mysqli_real_escape_string($con, $_POST['role']);

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

        if(empty($role)) {
            $roleErr = array("*Please eneter the role of the Engineer");
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['role'])) {
                $roleErr = array("*Only letters and white space allowed");
            }
        }
        

        $email_check = "SELECT * FROM `engineer` WHERE email = '$email'";
        $res = mysqli_query($con, $email_check); 
        if($res) {
            if(mysqli_num_rows($res) > 0){
                $emailErr = array("*Email that you have entered is already exist!");
            }
            if(count($nameErr) === 0 && count($emailErr) === 0 && count($passwordErr) === 0 && count($cpasswordErr) === 0 ) {
                $insert_data = "INSERT INTO engineer (name, email, password, role) values('$name', '$email', '$password', '$role')";
                $data_check = mysqli_query($con, $insert_data);
                if($data_check) {
                    $_SESSION['message'] = "New Engineer has been registered successfully";
                    header('location: manage-engineer.php');
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
                        window.location.href='add-engineer.php';
                     </script>
            ";
        }
    }

    if(isset($_POST['modify'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $role = mysqli_real_escape_string($con, $_POST['role']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
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


        if(empty($password)) {
            $passwordErr = array("*Password is required");
            $countErr++;
        } else {
            if (strlen($_POST["password"]) < 8) {
                $passwordErr = array("*Password must be at least 8 characters");
                $countErr++;
            } elseif (! preg_match("/[a-z]/i", $_POST["password"])) {
                $passwordErr = array("*Password must contain at least one letter");
                $countErr++;
            } elseif (! preg_match("/[0-9]/", $_POST["password"])) {
                $passwordErr = array("*Password must contain at least one number");
                $countErr++;
            }
        }

        if(empty($role)) {
            $roleErr = array("*Please eneter the role of the Engineer");
            $countErr++;
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['role'])) {
                $roleErr = array("*Only letters and white space allowed");
                $countErr++;
            }
        }

        if($countErr === 0) {
            $insert_data = "UPDATE `engineer` SET name = '$name', role = '$role', password = '$password' WHERE id = '$id'";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "Engineer data has been updated successfully";
                header('location: manage-engineer.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                    </script>";
            }
        }

        
    }

    if(isset($_POST['forward'])){
        $engi = mysqli_real_escape_string($con, $_POST['engi']);
        $ID = mysqli_real_escape_string($con, $_POST['id']);
        $refno = mysqli_real_escape_string($con, $_POST['refno']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contactno = mysqli_real_escape_string($con, $_POST['contact']);
        $apartmentno = mysqli_real_escape_string($con, $_POST['apart']);
        $subject = mysqli_real_escape_string($con, $_POST['sub']);
        $complaint = mysqli_real_escape_string($con, $_POST['cmp']);
        $urgency = mysqli_real_escape_string($con, $_POST['urgency']);
        $date = mysqli_real_escape_string($con, $_POST['date']);

        $sql = "SELECT * FROM `engineer` WHERE `name` = '$engi'";
        $r = mysqli_query($con,$sql);
        while($arr=mysqli_fetch_assoc($r)) {
            $engi_email = $arr['email'];
        }

        if($engi=='Select Engineer') {
            $engiErr = array("*Please Select a Engineer to forward Complaint");
        }

        if(count($engiErr) === 0) {
            $status = "inprogress";
            $update_data = "UPDATE `complaint` SET status = '$status' WHERE id = '$ID'";
            $result = mysqli_query($con, $update_data);
            if($update_data) {
                $email_check = "SELECT * FROM `view_cmp` WHERE refno = '$refno'";
                $res = mysqli_query($con, $email_check); 
                if($res) {
                    if(mysqli_num_rows($res) > 0){
                        $engiErr = array("Complaint has been already forwarded!");
                    }
                    else {
                        $insert_data = "INSERT INTO `view_cmp`(`cmp_id`, `name`, `email`, `refno`, `contactno`, `apartmentno`, `subject`, `complaint`, `urgency`, `date`, `engineer`, `status`) VALUES ('$ID','$name','$email','$refno','$contactno','$apartmentno','$subject','$complaint', '$urgency', '$date','$engi','$status')";
                        $data_check = mysqli_query($con, $insert_data);
                        if($data_check) {
                            sendMailUser($name, $email, $refno);
                            //sendMail($engi, $engi_mail);
                            $_SESSION['message'] = "Complaint has been forwarded Successfully";
                            header('location: complaint.php');
                        } else {
                            echo "<script>
                                    alert('Failed while inserting data into database!');
                                </script>";
                        }
                    }
                
                }
            }
        }
    }

    
?>
