<?php
    require "../connection.php";
    require "../session.php";

    $emailErr = array(); 
    $passwordErr = array();
    $captchaErr = array();
    $errors = array();
    $opErr = array();
    $npErr = array();
    $rpErr = array();
    $statusErr = array();

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
                $check_email = "SELECT * FROM `engineer` WHERE email = '$email'";
                $res = mysqli_query($con, $check_email);
                if(mysqli_num_rows($res) > 0){
                    $fetch = mysqli_fetch_assoc($res);
                    $fetch_pass = $fetch['password'];
                    if($password == $fetch_pass){
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: engineer-dashboard.php');
                    }else{
                        $errors = array("Incorrect email or password!");
                    }
                }else{
                    $errors = array("It's look like you're not yet a registrated Engineer!");
                }
            }
        }    
    }

    if(isset($_POST['update-profile'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $role = mysqli_real_escape_string($con, $_POST['role']);

        $insert_data = "UPDATE `engineer` SET name = '$name', contact = '$contact' WHERE id = '$id'";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check) {
            $_SESSION['message'] = "Your data has been updated successfully";
            header('location: profile.php');
        }
        else {
            echo "<script>
                    alert('Failed while inserting data into database!');
                  </script>";
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
        }

        if(empty($rp)) {
            $rpErr = array("*This field cannot remain empty");
        } else {
            if ($np !== $rp) {
                $rpErr = array("*Repeat Password not matched!");
            } else {
                $sql = "SELECT * FROM engineer WHERE id='$id'";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    $fetch = mysqli_fetch_assoc($res);
                    $fetch_pass = $fetch['password'];
                    if(password_verify($op, $fetch_pass)){
                        $password_hash = password_hash($_POST["np"], PASSWORD_DEFAULT);
                        $insert_data = "UPDATE `engineer` SET password = '$password_hash' WHERE id = '$id'";
                        $data_check = mysqli_query($con, $insert_data);
                        if($data_check) {
                            $_SESSION['message'] = "Your Password has been changed successfully";
                            header('location: profile.php');
                        }
                        else {
                            echo "<script>
                                    alert('Failed while inserting data into database!');
                                </script>";
                        }
                    }
                    else {
                        echo "<script>
                                alert('Old Password is not correct!');
                            </script>";
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

    if(isset($_POST['done'])){
        $status = mysqli_real_escape_string($con, $_POST['status']);
        $cmpID = mysqli_real_escape_string($con, $_POST['id']);

        if($status=='Select') {
            $statusErr = array("*Please select an option to continue!");
        }

        if(count($statusErr) === 0) {
            $update_date = "UPDATE `complaint` SET status = '$status' WHERE id = '$cmpID'";
            $result = mysqli_query($con, $update_date);
            $insert_data = "UPDATE `view_cmp` SET status = '$status' WHERE cmp_id = '$cmpID'";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "Complaint Process Done!";
                header('location: inbox.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                    </script>";
            }
        }
    }
?>
