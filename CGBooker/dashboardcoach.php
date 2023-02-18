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
    <style>
        #tableOfResult {
            display: none;
        }
    </style>

</head>
<body>
<style>
    .navbar {
        background-color: #ffffff;
        box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.1);
        font-family: "Segoe UI";
    }
    #tableOfResult{
        font-size: 8px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #25a141;">
    <div class="container-fluid">
        <a class="navbar-brand" href="Login.php">
            <span style="font-weight: bold; color: #fff;">THE GAMES</span>
        </a>
        <?php if ($_SESSION["loggedIn"]) { ?>
            <a class="nav-link" href="LogOut.php" style="color: #fff;">Log out</a>
        <?php } else { ?>
            <a class="nav-link" href="Login.php" style="color: #fff;">Log In</a>
        <?php } ?>
    </div>
</nav>
<div id="container">


    <div class="dashboard">
        <div class="row">
            <div class="col-lg-6">
                <button onclick="displayTable()">Schedule</button>
                <button onclick="closeDisplayTable()">Hide</button>
            </div>
            <button onclick="displayTableOfForm()">Book Room</button>
            <script>
                function displayTable() {
                    document.getElementById('tableOfResult').style.display = 'block';
                }
                function closeDisplayTable() {
                    document.getElementById('tableOfResult').style.display = 'None';
                }
                function displayTableOfForm(){
                    document.getElementById('tableOfResult').style.display = 'block';
                }

            </script>
        </div>

    </div>

    <div id="tableOfResult">
        <?php
        //For client_id should store in seesion when the client login
        //For now, do test assign the client_id as 1
        $client_id = (int)1;
        //Sort type
        $sort = " order by registration.day ,registration.segment_Id Desc";

        //Display book inventory
        $query = "SELECT * FROM registration WHERE client_id = '" . $client_id . "' " . $sort . ";";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.
        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }
        echo "<p>Number of orders found: " . $num_results . "</p>";
        echo "<h3>Your room orders</h3>";
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

            echo "<th>Action</th>";

            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {
                    $ord_Id = 0;
                    if ($k == 'reg_Id') {
                        echo "<td>" . $v . "</td>";
                        $reg_Id = $v;
                    } else {
                        echo "<td>" . $v . "</td>";
                    }
                    if (($i == count($order) - 1)) {
                        echo "<td>";
                        echo "<div class='btn-toolbar'>";
                        echo "<a href='Room/roomEdit.php?reg_Id=" . $reg_Id . "' title='Edit Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Edit</a>";
                        echo "<a href='Room/roomCancel.php?reg_Id=" . $reg_Id . "' title='Cancel Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Cancel</a>";
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
        // free result and disconnect
        $result->free();
        $mysqli->close();

        ?>


    </div>


</body>



<?php
