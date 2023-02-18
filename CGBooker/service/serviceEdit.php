<?php
include('../sessionChecked.php');
if (isset($_GET['ord_Id'])) {
    require_once('..\DataBase\config.php');
    $ord_Id = $mysqli->real_escape_string($_GET['ord_Id']);
    $query = "SELECT * FROM service_order WHERE ord_Id = $ord_Id";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;
    if ($num_results == 0) {

    } else {
        $row = $result->fetch_assoc();
        $time = $row['checkin_Time'];
        $day = $row['day'];
        $note=$row['note'];


    }

    $result->free();
    $mysqli->close();
}
?>

<!doctype html>
<html>
<head>
    <title>Book-O-Rama - Edit Book Entry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="container">
    <!-- <p><a href="newBook.php">Add a new book</a> - <a href="inventory.php">View all Books</a></p>-->

    <h1>Service-Edit</h1>
    <?php
    // if message gets set above it means there is a problem and we don't have a book with that id to edit or it isn't provided
    if (isset($message)) {
        echo $message;
    } else {
        // we have all we need so let's display the book
        ?>
        <div class="newBook-form">
            <form action="serviceEdit-process.php" method="post">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Service Booked- Update Service</legend>
                    <div class="form-group">
                        <h4>Athlete: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h4><br>
                        <h5>Province: <?php echo $_SESSION['province']; ?></h5>
                        <label for="Date">Date</label>
                        <input type="date" min="2023-02-18" max="2023-03-05" class="form-control" name="date" id="date"
                               value='<?php echo $day; ?>' required>

                        <div class="form-group">
                            <label for="shift">Preferred Time:</label>
                            <select name="checkInTime" id="checkInTime" required>
                                <?php
                                $checkinTime = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00"];
                                foreach ($checkinTime as $period) {
                                    ?>
                                    <option value=<?php echo $period; ?>><?php echo $period; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea class="form-control" name="note" id="note" ><?php echo $note; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ord_Id" value='<?php echo $ord_Id ?>'
                               name="ord_Id">
                        <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <?php
    } // close the if no book found $message above
    ?>
</body>
</html>