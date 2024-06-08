<?php
    require "connection.php";

    $refErr = array();
    $nameErr = array();
    $emailErr = array();
    $contactErr = array();
    $apartmentErr = array();
    $subjectErr = array();
    $complaintErr = array();
    $urgencyErr = array();

    if(isset($_POST['submit'])) {
        $ID = mysqli_real_escape_string($con, $_POST['id']);
        $refno = mysqli_real_escape_string($con, $_POST['refno']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contactno = mysqli_real_escape_string($con, $_POST['contact']);
        $apartmentno = mysqli_real_escape_string($con, $_POST['apartment']);
        $subject = mysqli_real_escape_string($con, $_POST['subject']);
        $complaint = mysqli_real_escape_string($con, $_POST['complaint']);
        $urgency = mysqli_real_escape_string($con, $_POST['urgency']);

        $contactno = filter_var($contactno, FILTER_SANITIZE_STRING);

        if(empty($refno)) {
            $refErr = array("*Refference Number is required");
        }

        if(empty($name)) {
            $nameErr = array("*Name is required");
        }

        if(empty($email)) {
            $emailErr = array("*Email is required");
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = array("*Invalid email format");
            }
        }

        if(empty($contactno)) {
            $contactErr = array("*Phone Number is required");
        } else {
            if (!preg_match('/^[0-9]{10}$/', $contactno)) {
                $contactErr = array("*Invalid mobile number format. Please enter a 10-digit number.");
            }
        }

        if(empty($apartmentno)) {
            $apartmentErr = array("*Apartment Number is required");
        } else {
            if (!preg_match("/^[A-Za-z0-9\- ]+$/",$apartmentno)) {
                $apartmentErr = array("*Please enter a valid apartment number");
            }
        }

        if(empty($subject)) {
            $subjectErr = array("*Please enter the subject of your complaint");
        }

        if(empty($complaint)) {
            $complaintErr = array("*Please enter your complaint in details");
        }

        if(empty($urgency)) {
            $urgencyErr = array("*Please select atleast one option");
        }

        if(count($refErr) === 0 && count($nameErr) === 0 && count($emailErr) === 0 && count($contactErr) === 0 && count($apartmentErr) === 0 && count($subjectErr) === 0 && count($complaintErr) === 0 && count($urgencyErr) === 0) {
            $status = "pending";
            $insert_data = "INSERT INTO complaint (profile_id, name, email, refno, contactno, apartmentno, subject, complaint, urgency, status) VALUES ('$ID','$name','$email','$refno','$contactno','$apartmentno','$subject','$complaint','$urgency','$status')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check) {
                $_SESSION['message'] = "Your Complaint has been registered successfully";
                header('location: home.php');
            }
            else {
                echo "<script>
                        alert('Failed while inserting data into database!');
                      </script>";
            }
        }
    }
?>
