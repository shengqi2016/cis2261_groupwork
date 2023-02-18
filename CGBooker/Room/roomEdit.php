<?php
include('../sessionChecked.php');
require_once('..\DataBase\config.php');
include('../InformationSession.php');
if (isset($_GET['reg_Id'])) {
    $reg_Id = $mysqli->real_escape_string($_GET['reg_Id']);
    $query = "SELECT * FROM registration WHERE reg_Id = $reg_Id";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;
    if ($num_results == 0) {

    } else {
        $row = $result->fetch_assoc();
        $timePeriod = $row['segment_Id'];
        $date = $row['day'];
        $note = $row['note'];


    }

    $result->free();
    $mysqli->close();
}
?>

<!doctype html>
<html>
<head>
    <title>Room-Edit</title>
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
    <h1>Room-Edit</h1>

    <?php
    // if message gets set above it means there is a problem and we don't have a book with that id to edit or it isn't provided
    if (isset($message)) {
        echo $message;
    } else {
        // we have all we need so let's display the book
        ?>
        <div class="newBook-form">
            <form action="roomEdit-process.php" method="post">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Room Booked- Update</legend>
                    <div class="form-group">
                        <h4>Coach: <?php echo $_SESSION['firstname']." " .$_SESSION['lastname'] ; ?></h4><br>
                        <h5>Province: <?php echo $_SESSION['province']; ?></h5>

                        <select name="timePeriod" id="timePeriod" >
                            <option value=""disabled selected>Select a time period</option>
                            <?php $i=1;
                            $segmentPeriod=$_SESSION['segmentPeriod'];
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
                        <input type="date" min="2023-02-18" max="2023-03-05" class="form-control" name="date" id="date"  value='<?php echo $date; ?>' required>
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea type="text"  class="form-control" name="note" id="note" ><?php echo $note; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="reg_Id" value='<?php echo $reg_Id; ?>'  name="reg_Id">
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