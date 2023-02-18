<?php

$reg_Id='';
if(isset($_GET['reg_Id'])){
    require_once('..\DataBase\config.php');
    $reg_Id = $mysqli->real_escape_string($_GET['reg_Id']);
    if ($stmt = $mysqli->prepare("DELETE FROM registration WHERE reg_Id = ?")) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $reg_Id);

        //Set parameter and execute
        $ord_Id = $mysqli->real_escape_string($_GET['reg_Id']);
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {

            // Close statement
            $stmt->close();
            // Records deleted successfully. Redirect to landing page
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}else{
    echo "Error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RoomCancel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="container">
    <h2 style="text-align: center">Rooms Cancellation</h2>
    <h3 style="text-align: center"><?php echo  "The room order have been cancelled."; ?></h3><br> <a href='../index.php'><h3 style="text-align: center" >View schedule</h3></a>
</div>
</body>
</html>
