<!doctype html>
<html>
<head>
    <title>Book-O-Rama - Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="container">
 <h1 style='text-align: center'>Service Booking Update</h1>
<?php
if(isset($_POST['update'])) {
    $checkInTime=$_POST['checkInTime'];
    $date=$_POST['date'];
    if(intval($checkInTime)<12.8){
        $shift='9:00-13:00';
    }else if(intval($checkInTime) >=13&&intval($checkInTime)<15.9){
        $shift='13:00-16:00';
    }else if(intval($checkInTime) >=16 &&intval($checkInTime)<22.1) {
        $shift = '16:00-22:00';
    }
    $note=$_POST['note'];
    $ord_Id=$_POST['ord_Id'];
    if (empty($date) || empty($checkInTime)) {
        echo "You have not filled out anything.<br />"
            . "Please go back and try again.</body></html>";
        exit;
    }
    require_once('..\DataBase\config.php');
    $date=$mysqli->real_escape_string($date);
    $shift=$mysqli->real_escape_string($shift);
    $query = "UPDATE service_order SET checkin_Time='$checkInTime', day='$date' ,shift='$shift',note='$note' WHERE service_order.ord_Id=$ord_Id LIMIT 1";
    $result = $mysqli->query($query);
    if ($result) {
        echo "<h4 style='text-align: center'>".$mysqli->affected_rows."   " . "Services Order have been updated in database</h4> . <a href='../dashboardathlete.php'><h3 style='text-align: center'>View schedule</h3></a>";

}else{
        echo "An error has occurred.  The item was not updated";
    }


    $mysqli->close();

}else{
    header("location:serviceEdit.php");
    exit();
}
?>
</div>
</body>
</html>

