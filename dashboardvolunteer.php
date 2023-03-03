<?php
include("sessionChecked.php");
include("DataBase/config.php");
include('InformationSession.php');
?>

    <!doctype html>
    <html>
<head>
    <title>DashBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/TheGamesLayOut.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>


</head>
<body>
<div id="container" style="width: 80%;margin: auto" >

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="Resource/TheGamesLoGo.png" alt="" width="30" height="24"
                     class="d-inline-block align-text-top">
                THEGAMES
            </a>
            <li class="navbar-nav me-auto mb-2 mb-lg-0">
            </li>
            <?php
            if ($_SESSION["loggedIn"]) {
                ?>
                <span class="navbar-text">
                           Hello, Volunteer <?php echo $first_Name; ?>
                        </span>
                <span>

</span>
                <li class="nav-item" style=" list-style-type:None">
                    <a class="nav-link" href="LogOut.php">Log out</a>
                </li>

                <?php
            } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="Login.php">Log In</a>
                </li>
                <?php
            }
            ?>

        </div>
    </nav>
    <div class="dashboard">
        <div class="row">
            <div class="col-lg-6">
                <button onclick="displayTable()">Schedule</button>
                <button onclick="closeDisplayTable()">Hide</button>
            </div>
            <p id="demo"></p>
            <script>
                function displayTable() {
                    document.getElementById('tableOfResult').style.display = 'block';
                    document.getElementById('tableOfSchedule').style.display = 'block';
                }
                function closeDisplayTable() {
                    document.getElementById('tableOfResult').style.display = 'None';
                    document.getElementById('tableOfSchedule').style.display = 'None';
                }

            </script>
        </div>



    </div>
    <div id="tableOfResult">
        <?php

        //Sort type
        $sort = " order by service_order.day , service_order.checkin_time";

        //Display book inventory
        $query = "SELECT * FROM staff_schedule join service_order on staff_schedule.ord_Id = service_order.ord_Id WHERE item_status = 'confirmed' AND staff_Schedule.employee_Num = '". $employee_Num ."' " . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.
        echo $query;
        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<p>Number of comfired orders found: " . $num_results . "</p>";
        echo "<h3>All your service confirmed orders</h3>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        if ($num_results > 0) {
//  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-bordered'><tr>";
//This dynamically retieves header names
            foreach ($orders[0] as $k => $v) {

                echo "<th>" . $k . "</th>";

            }


            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {


                    echo "<td>" . $v . "</td>";

                    $i++;
                }
                echo "</tr>";

            }
            echo "</td></tr>";

            echo "</tbody>";
            echo "</table>";
        }


        ?>


    </div>


    <div id="tableOfSchedule">
        <?php


        //Sort type
        $sort = " order by day , shift";

        //Display book inventory
        $query = "SELECT * FROM staff_schedule WHERE item_status = 'available' AND employee_Num = '". $employee_Num ."'" . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.
        echo $query;
        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<p>Number of not comfired orders found: " . $num_results . "</p>";
        echo "<h3>All Athlete service waiting confirmed orders</h3>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        if ($num_results > 0) {
//  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-bordered'><tr>";
//This dynamically retieves header names
            foreach ($orders[0] as $k => $v) {

                echo "<th>" . $k . "</th>";

            }


            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {

                    echo "<td>" . $v . "</td>";

                    $i++;
                }
                echo "</tr>";

            }
            echo "</td></tr>";

            echo "</tbody>";
            echo "</table>";
        }
        // free result and disconnect
        $result->free();
        $mysqli->close();

        ?>


    </div>

</body>



<?php
