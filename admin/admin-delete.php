<?php
    include("../connection.php");
    include("../session.php");

    $adminID = $_GET['id'];

    $query = "DELETE FROM `admin` WHERE id = '$adminID'";
    $result = mysqli_query($con,$query);

    if($result) {
        $_SESSION['message'] = "Admin has been removed successfully";
        $_SESSION['check'] = $adminID;
        header('location: manage-admin.php');
    }
    else {
        echo "<script>
                alert('Failed while inserting data into database!');
              </script>";
    }
?>

