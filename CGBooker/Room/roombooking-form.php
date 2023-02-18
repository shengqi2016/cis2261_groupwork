<?php
include('../sessionChecked.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Room Booking</title>
    <!-- Include the Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Include the Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">

</head>
<body>
<div id="container">
    <h1>Book a room</h1>
    <br>
    <form action="roomprocess-booking.php" method="post" id="booking-form">
        <h4>Coach: <?php echo $_SESSION['firstname']." " .$_SESSION['lastname'] ; ?></h4><br>
        <h5>Province: <?php echo $_SESSION['province']."<br><br>"."Your room Location is  ". $_SESSION['location'].
                "<br><br>"."Room Number: ".$_SESSION['roomNum']; ?></h5>
        <div class="form-group">
            <label for="Room">Room:</label>
            <?php   $segmentPeriod=$_SESSION['segmentPeriod'];
            ?>

            <select name="timePeriod" id="timePeriod" required>
                <option value=""disabled selected>Select a time period</option>
            <?php $i=1;
                foreach ($segmentPeriod as $periods ) {
                 foreach( $periods as $period) {
                     echo '<option  value=' . $i . '>' . $period . '</option>';
                 }
                                $i++;
             }
                 ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" min="2023-02-18" max="2023-03-05" class="form-control" name="date" id="date" required>
        </div>
        <div class="form-group">
            <label for="qty">Note:</label>
            <textarea type="text"  class="form-control" name="note" id="note"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Room Booking</button>
    </form>
</div>
</body>
</html>
