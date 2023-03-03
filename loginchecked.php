<?php
include("DataBase/config.php");
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
    echo '<script>alert("loginchecked")</script>';
    $query = "SELECT specialty FROM staff WHERE BINARY email='".$_SESSION["username"] ."'";
    $result=$mysqli->query($query);
    $row=mysqli_fetch_assoc($result);
    $formOfRole=$row["specialty"];
    if($formOfRole=="Admin"){
        header("location:dashboardadmin.php");
        exit;
    }else if($formOfRole=="volunteer"){
        header("location:dashboardvolunteer.php");
        exit;
    }
}