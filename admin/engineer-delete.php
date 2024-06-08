<?php
    include("../connection.php");
    include("../session.php");

    $adminID = $_GET['id'];

    $query = "DELETE FROM `engineer` WHERE id = '$adminID'";
    $result = mysqli_query($con,$query);

    if($result) {
        $_SESSION['message'] = "Engineer has been removed successfully";
        $_SESSION['check'] = $adminID;
        header('location: manage-engineer.php');
    }
    else {
        echo "<script>
                alert('Failed while inserting data into database!');
              </script>";
    }
?>