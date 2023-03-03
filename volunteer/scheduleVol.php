<?php
include_once("../sessionChecked.php");
include("../DataBase/config.php");
include('../InformationSession.php');
?>

<?php
function updateStaffScheduleTable($itemId,$status){

    $query = "UPDATE staff_Schedule SET item_Status = '".$status."' WHERE item_Id = '".$itemId."';";
    $result = $mysqli->query($query);

}

$days=array('2023-02-18', '2023-02-19', '2023-02-20', '2023-02-21', '2023-02-22', '2023-02-23', '2023-02-24', '2023-02-25',
    '2023-02-26', '2023-02-27', '2023-02-28', '2023-03-01', '2023-03-02', '2023-03-03', '2023-03-04', '2023-03-05');

$shifts = array('9:00-13:00', '13:00-17:00', '19:00-22:00');

$volunteers = array();
$employeeNums = array();
//Get volunteer list from database

$sort = " ORDER BY last_Name, first_Name;";

$query = "SELECT last_Name, first_Name, employee_Num FROM staff WHERE specialty != 'Admin'".$sort;

// Here we use our $db object created above and run the query() method. We pass it our query from above.

$result = $mysqli->query($query);

$num_results = $result->num_rows;
if (isset($_GET['msg'])) {
    echo "<p>{$_GET['msg']}</p>";
}


if ($num_results > 0) {
    $noVolunteer = false;
//  $result->fetch_all(MYSQLI_ASSOC) returns a numeric array of all the books retrieved with the query
    $orders = $result->fetch_all(MYSQLI_ASSOC);

//Create a new row for each order
    foreach ($orders as $order) {

        $i = 0;
        $name='';

        foreach ($order as $k => $v) {

            if ($k == 'employee_Num') {
                $employeeNums[] = $v;
            }

            if ($k == 'last_Name'){
                $name = $v;
            }
            if ($k == 'first_Name'){
                $name = $v.' '.$name;
            }

            $volunteers[]=$name;

            $i++;
        }


    }

}else{
    $noVolunteer = true;
}

?>

    <!doctype html>
    <html>
<head>
    <title>Schedule Volunteer</title>
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
            <a class="navbar-brand" href="../index.php">
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
                           Hello, Admin <?php echo $_SESSION['firstname']; ?>.
                        </span>
                <span>

</span>
                <li class="nav-item" style=" list-style-type:None">
                    <a class="nav-link" href="../LogOut.php">Log out</a>
                </li>

                <?php
            } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../Login.php">Log In</a>
                </li>
                <?php
            }
            ?>

        </div>
    </nav>
    <div class="dashboard">
        <div class="row">


<!--            --><?php
//                if ($volunteers){
//                    echo "<h4>There is no volunteer. Please go bach to dashboard to add volunteer first.</h4>";
//                    echo "<h4><a href='../dashboardadmin.php'>Go to Dashboard</a></h4>";
//                } else {
//
//?>
            <div class="col-md-2"><h4>The Volunteer</h4></div>
            <div class="col-md-4">
                <select class="form-control" id="volunteers" name="volunteers" required>
                    <?php
                    $item=0;
                    foreach ($volunteers as $volunteer) {

                        echo "<option value='$employeeNums[$item]'>$volunteer</option>";
                        $item++;
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <button onclick="displayScheduleTable()">Schedule</button>
            </div>
<!--           --><?php //}?>


            <script>
                function displayScheduleTable() {
<!--                    --><?php
//                    $volEmployeeNum = document.getElementById('Volunteers').value;
//                    ?>
                    document.getElementById('tableOfScheduleVolunteers').style.display = 'block';
                }



            </script>

        </div>

    </div>


    <div id="tableOfScheduleVolunteers">
        <?php
        //temp make the $volEmployeeNum as 9
        $volEmployeeNum=9;

        $query = "SELECT specialty FROM staff WHERE employee_Num = '".$volEmployeeNum."';";
        $result = $mysqli->query($query);
        $orders = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($orders as $order) {
            $i = 0;
            foreach ($order as $k => $v) {
                $specialty = $v;
            }
            $i++;
        }
        echo "<h4>Volunteer name: ".$name."</h4>";
        echo "<h4>Specialty: ".$specialty."</h4>";

        //start to show schedule table
       echo "<table class='table table-bordered table-striped'>";
       echo "<thead>";
       echo "<table class='table table-bordered'><tr>";

       echo "<th>Day</th>";
       echo "<th>Shift</th>";
       echo "<th>Status</th>";
       echo "<th>Action</th>";

       echo "</tr></thead>";
       echo "<tbody>";

       foreach ($days as $day){
           foreach ($shifts as $shift){
               echo "<tr>";
               echo "<td>".$day."</td>";
               echo "<td>".$shift."</td>";

               //Get status for the item in the staff_schedule table
               $query = "SELECT item_Status, item_Id FROM staff_Schedule WHERE employee_Num = '".$volEmployeeNum."' AND day='".$day."' AND shift = '".$shift."';";
               $result = $mysqli->query($query);
               $orders = $result->fetch_all(MYSQLI_ASSOC);
               $status ="";

               foreach ($orders as $order) {
                   $i = 0;
                   foreach ($order as $k => $v) {
                       if($k=='item_Id'){
                           $itemId = $v;
                       }else{
                            $status = $v;
                       }
                   }
                   $i++;
               }

               if ($status == 'confirmed'){
                   echo "<td><select class='input' name ='status' style='background: white' required>";
                   echo "<option value='confirmed' default>confirmed</option>";
               } else{
                   if ($status == 'available'){
                       echo "<td><select class='input' name ='status' style='background: #25a141' required>";
                       echo "<option value='available' default >available</option>";
                       echo "<option value='unavailable'>unavailable</option>";
                   }else{
                       echo "<td><select class='input' name ='status' style='background:red' required>";
                       echo "<option value='unavailable'>unavailable</option>";
                       echo "<option value='available'>available</option>";

                   }

               }

               echo "</td>";
               echo "<td><button onclick='updateStaffScheduleTable($itemId,$status)'>Update</button></td>";
               echo "</tr>";


           }
       }







        echo "</tbody>";
        echo "</table>";
        echo "</thead>";
        echo "</table>";
        // free result and disconnect
        $result->free();
        $mysqli->close();

        ?>



    </div>


</body>



<?php
