<?php

include('../sessionChecked.php');
//use client_Id as 1 for test

// Get the form data
$service = $_POST['service'];
$coachOrAthlete = 0;
$date = $_POST['date'];
$checkInTime=$_POST['checkInTime'];
$note=$_POST['note'];
if(intval($checkInTime)<12.8){
    $shift='9:00-13:00';
}else if(intval($checkInTime) >=13&&intval($checkInTime)<15.9){
    $shift='13:00-16:00';
}else if(intval($checkInTime) >=16 &&intval($checkInTime)<22.1) {
    $shift = '16:00-22:00';
}
// Validate the form data
if (empty($service) || empty($date) || empty($checkInTime)) {
    // Display an error message if any of the fields are empty
    echo "Please fill out all fields.";
    exit;
}

//creat an order (for now not sure about the room rule for Service)
include_once('../DataBase/config.php');
$status = 'ordered';
$query = "INSERT INTO service_Order VALUES (NULL,'" . $_SESSION['clientId'] . "', '" . $service . "', '" . $date . "', '". $shift . "', '" . $checkInTime .  "', '" .$status ."', '" .$note . "');";
$mysqli->query($query);
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Booking Complete</title>
    <link href="../css/TheGamesLayOut.css">
<style>
    #container {
        width: 80%;
        margin: 5%;
        font-family:"Times New Roman";
        background-color: darkseagreen;
        padding: 5%;
        border-radius: 25px;
        border: 2px solid white;
    }
</style>
</head>
<body>
<div id="container">
  <h1>Booking Complete</h1>
  <p>Thank you for your booking! Your reservation has been confirmed.</p>
  <p>Here are the details of your booking:</p>
  <ul>
    <li>Service: <?php  switch ($_POST['service']){
            case 1:
                $Service="Mental Health Check description";
                break;
            case 2:
                $Service="Doctor's Assessment description";
                break;
            case 3:
                $Service="Physician";
                break;
            case 4:
                $Service="Nurse Practioner";
                break;
            case 5:
                $Service="R Massage";
                break;
            case 6:
                $Service="Physiotherapist";
                break;
            case 7:
                $Service="Chripractor";
                break;
            case 8:
                $Service="R Nurse";
                break;
            case 9:
                $Service="PT or AT";
                break;
            case 10:
                $Service="Reception";
                break;
        }
        echo   $Service; ?></li>
<li>Date: <?php echo $_POST['date']."    |  ".$shift ; ?></li>

      <a href="../dashboardathlete.php">Go Back</a>
</ul>
</div>
</body>
</html>