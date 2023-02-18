<?php
include('../sessionChecked.php');
include_once('..\DataBase\config.php');
//use client_Id as 1 for test
$client_Id = 1;

// Get the form data
$timePeriod = $_POST['timePeriod'];
$date = $_POST['date'];
$note = $_POST['note'];

// Validate the form data
if (empty($timePeriod) || empty($date)) {
    echo "<script>alert('work')</script>";
    // Display an error message if any of the fields are empty
    echo "Please fill out all fields.";
}else{
    $timePeriod = $mysqli->real_escape_string($timePeriod);
    $date = $mysqli->real_escape_string($date);
    $note = $mysqli->real_escape_string($note);
    $status = 'ordered';
    $query = "INSERT INTO registration VALUES (NULL,'" . $_SESSION['roomNum'] . "', '" . $timePeriod . "', '" . $client_Id . "', '" . $date . "', '". $status . "', '". $note . "');";

    $mysqli->query($query);

    mysqli_close($mysqli);
}
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
        <li>Room: <?php echo $_SESSION['roomNum']; ?></li>
        <li>Date: <?php echo $_POST['date']; ?></li>
        <li>Time: <?php echo $_POST['timePeriod']; ?></li>

        <a href="../index.php">Go Back</a>
    </ul>
</div>
</body>
</html>