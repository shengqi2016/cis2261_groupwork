<?php
include("../DataBase/config.php");
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) ) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
</head>
<body>
<div class="container" id="container">
    <div id="confirmation">
        <h1>Confirmation</h1>
        <?php
        date_default_timezone_set("America/New_York");
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $specialty = $_POST['specialty'];
        $note = $_POST['note'];
        $password = $_POST['password'];

        //Inset to the staff table
        //Validation for the duplicated account
        $query = "SELECT email FROM staff WHERE BINARY email='" . $email . "'";
        $result = $mysqli->query($query);
        if ($result->num_rows == 0) {
            $query = "INSERT into staff VALUES(null,'" . $lastName . "','" . $firstName . "','" . $email . "','" . $phoneNumber . "','" . $specialty . "'," . $note . ")";
            $result = $mysqli->query($query);

            echo "<h3>New volunteer: ".$firstName."  ".$lastName. "<br>" ."Username: ".$email." </h3><br>";
            echo "<br>"."Current time is " . date("Y-m-d h:i:sa");

            $query = "INSERT into account VALUES('" . $email . "','" . $password . "')";
            $result = $mysqli->query($query);

        } else {
            echo "<h3>Sorry, there are some problems in add new volunteer form. Please try it again. Thanks";

            echo "<br>"."Current time is " . date("Y-m-d h:i:sa");
            echo "<br>"."<a href='newVolunteer.php.php'><h2>Try again</h2></a>";
            ?>
            <?php

        }
        }else{
            header("Location:newVolunteer.php");
            exit();
        }
        ?>
    </div>



</div>
</body>




