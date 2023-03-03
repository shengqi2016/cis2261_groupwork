<?php
include_once("sessionChecked.php");
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
                           Hello, Admin <?php echo $_SESSION['firstname']; ?>.
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
            <div class="col-lg-3">
                <button onclick="displayRoomOrderTable()">View Room Orders</button>
                <button onclick="closeDisplayRoomOrderTable()">Hide Room Orders</button>
            </div>
            <div class="col-lg-3">
                <button onclick="displayConfirmedTable()">View Confirmed Orders</button>
                <button onclick="closeDisplayConfirmedTable()">Hide Confirmed Orders</button>
            </div>
            <div class="col-lg-3">
                <button onclick="displayUnconfirmedTable()">Process Orders</button>
                <button onclick="closeDisplayUnconfirmedTable()">Hide Orders</button>
            </div>
            <div class="col-lg-3">
                <button onclick="displayScheduleVolunteersTable()">Schedule Volunteers</button>
                <button onclick="closeDisplayScheduleVolunteersTable()">Hide Orders</button>
            </div>


            <script>
                function displayRoomOrderTable() {
                    document.getElementById('tableOfRoomOrder').style.display = 'block';
                }
                function closeDisplayRoomOrderTable() {
                    document.getElementById('tableOfRoomOrder').style.display = 'None';
                }
                function displayConfirmedTable() {
                    document.getElementById('tableOfResult').style.display = 'block';
                }
                function closeDisplayConfirmedTable() {
                    document.getElementById('tableOfResult').style.display = 'None';
                }
                function displayUnconfirmedTable() {
                    document.getElementById('tableOfOrdersNotConfirmed').style.display = 'block';
                }
                function closeDisplayUnconfirmedTable() {
                    document.getElementById('tableOfOrdersNotConfirmed').style.display = 'None';
                }
                function displayScheduleVolunteersTable() {
                    document.getElementById('tableOfScheduleVolunteers').style.display = 'block';
                }
                function closeDisplayScheduleVolunteersTable() {
                    document.getElementById('tableOfScheduleVolunteers').style.display = 'None';
                }

            </script>

        </div>

    </div>

    <div id="tableOfRoomOrder">
        <?php

        //Sort type
        $sort = " order by registration.day, registration.segment_ID";

        //Display book inventory
        $query = "SELECT client.first_Name AS 'First Name', client.last_Name AS 'Last Name', registration.day AS 'Day', 
                    segment.segment_Description AS 'Time', room.province AS 'Province', room.location AS 'Location' 
                    FROM registration JOIN segment ON registration.segment_Id = segment.segment_Id
                        JOIN room ON registration.room_Num = room.room_Num
                        JOIN client ON registration.client_Id = client.client_Id
                    WHERE registration.status = 'ordered'" . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.

        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<p>Number of comfired orders found: " . $num_results . "</p>";
        echo "<h3>All Room confirmed orders</h3>";
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

                    if ($k == 'ord_Id') {
                        echo "<td>" . $v . "</td>";
                        $ord_Id = $v;
                    } else {
                        echo "<td>" . $v . "</td>";
                        if ($k == 'item_Id'){
                            $itemId = $v;
                        }
                    }

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

    <div id="tableOfResult">
        <?php

        //Sort type
        $sort = " order by service_order.day , service_order.checkin_time";

        //Display book inventory
        $query = "SELECT service_Order.day AS 'Day', service_Order.shift AS 'Shift', service_Order.checkin_Time AS 'Checkin',
                        client.first_Name AS 'Client First Name', client.last_Name AS 'Clien Last Name', 
                        service.type AS 'Service', staff.first_name AS 'Server First Name', 
                        staff.last_Name AS 'Server Last Name', service_Order.ord_Id, staff_Schedule.item_Id  
                    FROM staff_schedule JOIN service_order ON staff_schedule.ord_Id = service_order.ord_Id
                        JOIN service ON service_Order.service_Id = service.service_Id
                        JOIN staff ON staff_Schedule.employee_Num = staff.employee_Num
                        JOIN client ON service_Order.client_Id = client.client_Id
                    WHERE item_status = 'confirmed' AND status = 'confirmed'" . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.


        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<p>Number of comfired orders found: " . $num_results . "</p>";
        echo "<h3>All Athlete service confirmed orders</h3>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        if ($num_results > 0) {
//  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-bordered'><tr>";
//This dynamically retieves header names
            foreach ($orders[0] as $k => $v) {

                if (($k != 'ord_Id') && ($k != 'item_Id')){
                    echo "<th>" . $k . "</th>";
                }

            }

            echo "<th>Action</th>";

            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {

                    if ($k == 'ord_Id') {
                        $ord_Id = $v;
                    }else if ($k == 'item_Id'){
                            $itemId = $v;
                    }else{
                        echo "<td>" . $v . "</td>";
                    }
                    if (($i == count($order) - 1)) {
                        echo "<td>";
                        echo "<div class='btn-toolbar'>";
                        echo "<a href='service/serviceEdit.php?ordId=" . $ord_Id . "&itemId=" . $itemId . "' title='Unconfirm Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Unconfirm</a>";
                        echo "<a href='service/serviceCancel.php?ordId=" . $ord_Id . "&itemId=" . $itemId . "' title='Cancel Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Cancel</a>";
                        echo "</div>";
                        echo "</td>";
                    }
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

    <div id="tableOfOrdersNotConfirmed">
        <?php


        //Sort type
        $sort = " order by service_order.day, service_order.checkin_time";

        //Display book inventory
        $query = "SELECT service_Order.day AS 'Day', service_Order.shift AS 'Shift', service_Order.checkin_Time AS 'Checkin',
                        client.first_Name AS 'Client First Name', client.last_Name AS 'Clien Last Name', 
                        service.type AS 'Service', service_Order.ord_Id, service_Order.shift 
                    FROM service_order JOIN client ON service_Order.client_Id = client.client_Id
                        JOIN service ON service_Order.service_Id = service.service_Id
                    WHERE service_Order.status = 'ordered' " . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.

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

                 if(($k != 'ord_Id') && ($k != 'shift')){
                     echo "<th>" . $k . "</th>";
                 }

            }

            echo "<th>Action</th>";

            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {

                    if ($k == 'ord_Id') {
                        $ord_Id = $v;
                    }else if ($k == 'shift'){
                        $orderShift = $v;
                    }else {
                        echo "<td>" . $v . "</td>";
                    }

                    if ($k == 'Day'){
                        $orderDay = $v;
                    }


                    if (($i == count($order) - 1)) {
                        echo "<td>";
                        echo "<div class='btn-toolbar'>";
                        echo "<a href='service/serviceOrderEdit.php?ordId=" . $ord_Id. "&day=" . $orderDay . "&shift=". $orderShift ."' title='Edit Order' class='btn btn-info btn-xs' data-toggle='tooltip'>process</a>";
                        echo "<a href='service/serviceOrderCancel.php?ordId=" . $ord_Id . "' title='Cancel Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Cancel</a>";
                        echo "</div>";
                        echo "</td>";
                    }
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

    <div id="tableOfScheduleVolunteers">
        <?php




        //Sort type
        $sort = " ORDER BY day, shift, specialty, last_Name, first_Name;";

        //Display Volunteers' Schedule
        $query = "SELECT staff_Schedule.day AS 'Day', staff_Schedule.shift AS 'Shift', staff.first_Name AS 'First Name',
                    staff.last_Name AS 'Last Name', staff_Schedule.item_Status AS 'Status', staff.specialty AS 'Specialty'
                    FROM staff_Schedule JOIN staff ON staff.employee_Num = staff_schedule.employee_Num".$sort;


        // Here we use our $db object created above and run the query() method. We pass it our query from above.

        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }

        ?>

        <div class="row">
            <div class="col-md-6">
                <h3>All Volunteers Schedule</h3>
            </div>
            <div class="col-md-3">
                <a href='volunteer/newVolunteer.php' title='New Volunteer' class='btn btn-info btn-xs' data-toggle='tooltip'>Add Volunteer</a>
            </div>
            <div class="col-md-3">
                <a href='volunteer/scheduleVol.php' title='Schedule Volunteer' class='btn btn-info btn-xs' data-toggle='tooltip'>Schedule Volunteer</a>
            </div>
        </div>

        <?php
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

                    if ($k == 'ord_Id') {
                        echo "<td>" . $v . "</td>";
                        $ord_Id = $v;
                    } else {
                        echo "<td>" . $v . "</td>";
                    }

                    if ($k == 'day'){
                        $orderDay = $v;
                    }
                    if ($k == 'shift'){
                        $orderShift = $v;
                    }

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
