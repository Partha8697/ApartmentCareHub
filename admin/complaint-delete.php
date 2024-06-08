<?php
    include("../connection.php");
    include("../session.php");

    $UserID = $_GET['id'];

    $query = "DELETE FROM `complaint` WHERE id = '$UserID'";
    $result = mysqli_query($con,$query);
    $sql = "DELETE FROM `view_cmp` WHERE cmp_id = '$UserID'";
    $res = mysqli_query($con,$sql);
    if($result) {
        $_SESSION['message'] = "Complaint has been removed successfully";
        header('location: complaint.php');
    }
    else {
        echo "<script>
                alert('Failed while inserting data into database!');
              </script>";
    }
?>