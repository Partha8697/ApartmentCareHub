<?php
    include("connection.php");
    include("session.php");

    $del_id = $_POST['delete_id'];

    $query = "DELETE FROM `user` WHERE id = $del_id";
    $result = mysqli_query($con,$query);

?>