<!doctype html>
<html>
<head>
    <title>Room- Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="container">
    <h1 style='text-align: center'>Room Booking Update</h1>
    <?php
    if(isset($_POST['update'])) {
        if(isset($_POST['timePeriod'])||isset($_POST['date'])) {
            $timePeriod = $_POST['timePeriod'];
            $date = $_POST['date'];
            $note = $_POST['note'];
            $reg_Id = $_POST['reg_Id'];
            require_once('..\DataBase\config.php');
            $timePeriod = $mysqli->real_escape_string($timePeriod);
            $date = $mysqli->real_escape_string($date);
            $note = $mysqli->real_escape_string($note);
            $query = "UPDATE registration SET segment_Id='$timePeriod', day='$date', note='$note' WHERE registration.reg_Id=$reg_Id LIMIT 1";
            $result = $mysqli->query($query);
            if ($result) {
                echo "<h4 style='text-align: center'>" . $mysqli->affected_rows . "   " . "Room Order have been updated in database</h4> . <a href='../index.php'><h3 style='text-align: center'>View schedule</h3></a>";

            } else {
                echo "An error has occurred.  The item was not updated";
            }


            $mysqli->close();
        }else{
            echo "You have not filled out anything.<br />"
            . "Please go back and try again.</body></html>" . "<br>" . "<a href='../index.php'>go back</a>";
            exit;

        }

    }else{
        header("location:roomEdit.php");
        exit();
    }
    ?>
</div>
</body>
</html>

