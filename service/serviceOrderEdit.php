<?php
include("../sessionChecked.php");
include("../DataBase/config.php");
include('../InformationSession.php');
?>

    <!doctype html>
    <html>
<head>
    <title>DashBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>


</head>
<body>
<div id="container" style="width: 80%;margin: auto" >

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../Resource/TheGamesLoGo.png" alt="" width="30" height="24"
                     class="d-inline-block align-text-top">
                THEGAMES
            </a>
            <li class="navbar-nav me-auto mb-2 mb-lg-0">
            </li>
            <?php
            if ($_SESSION["loggedIn"]) {
                ?>
                <span class="navbar-text">
                           Hello, Admin <?php echo $first_Name; ?>
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


        </div>



    </div>


    <div id="tableOfOrdersNotConfirmed">
        <?php
        $ord_Id = $_GET['ordId'];
        $day = $_GET['day'];
        $shift = $_GET['shift'];


        //Sort type



        $query = "SELECT service_Order.day AS 'Day', service_Order.shift AS 'Shift', service_Order.checkin_Time AS 'Checkin',
                        client.first_Name AS 'Client First Name', client.last_Name AS 'Clien Last Name', 
                        service.type AS 'Service', service_Order.note AS 'Note'  
                    FROM service_Order JOIN service ON service_Order.service_Id = service.service_Id
                        JOIN client ON service_Order.client_Id = client.client_Id
                    WHERE service_Order.ord_Id = " . $ord_Id .";";



        // Here we use our $db object created above and run the query() method. We pass it our query from above.

        $result = $mysqli->query($query);

        $num_results = $result->num_rows;
        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }

        echo "<h3>The Athlete service order</h3>";
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
                }



                if (($i == count($order) - 1)) {



                    $i++;
                }
                echo "</tr>";

            }
            echo "</td></tr>";

            echo "</tbody>";
            echo "</table>";
        }

        echo "<h4> Choose a volunteer to assign the service.</h4>";

        $query = "SELECT last_Name AS 'Last Name', first_Name AS 'First Name', staff_schedule.item_Id 
                    FROM staff_schedule JOIN staff ON staff_schedule.employee_Num = staff.employee_Num 
                    WHERE day = '" . $day ."' AND shift = '" . $shift . "';";


        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        if ($num_results> 0) {
//  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            echo "<table class='table table-bordered'><tr>";
//This dynamically retieves header names
            foreach ($orders[0] as $k => $v) {
                if($k=='item_Id'){
                    echo "<th>Available Volunteer</th>";
                }else {
                    echo "<th>" . $k . "</th>";
                }

            }

            echo "</tr></thead>";
            echo "<tbody>";
//Create a new row for each order
            foreach ($orders as $order) {
                echo "<tr>";
                $i = 0;

                foreach ($order as $k => $v) {
                    if($k=='item_Id'){
                        echo "<td><a href='serviceOrderConfirm.php?ordId=" . $ord_Id. "&itemId=" . $v . "' title='confirm Order' class='btn btn-info btn-xs' data-toggle='tooltip'>Assign</a></td>";
                    }else{
                        echo "<td>" . $v . "</td>";
                    }


                }

                echo "</tr>";

            }
            echo "</td></tr>";

            echo "</tbody>";
            echo "</table>";
        }else{
            echo "<h3>There is no volunteer available on this shift.</h3>";
            echo "<a href='../dashboardadmin.php' >Go Back</a>";
        }





        // free result and disconnect
        $result->free();
        $mysqli->close();

        ?>


    </div>

</body>



<?php
