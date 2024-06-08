<?php
    include("../connection.php");
    include("../session.php");

    $UserID = $_GET['id'];

    $query = "DELETE FROM `user` WHERE id = '$UserID'";
    $result = mysqli_query($con,$query);

    if($result) {
        $_SESSION['message'] = "User has been removed successfully";
        header('location: user.php');
    }
    else {
        echo "<script>
                alert('Failed while inserting data into database!');
              </script>";
    }
?>