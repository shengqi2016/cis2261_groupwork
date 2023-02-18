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
        <button class="tab-button" onclick="displayServiceForm()">Book an Appointment</button>
        <button class="tab-button" onclick="displayTable()">View Appointments</button>
        <button class="tab-button" onclick="displayTable()">Cancel an Appointment</button>
        <?php if ($_SESSION["loggedIn"]) { ?>
            <a class="nav-link" href="LogOut.php" style="color: #fff;">Log out</a>
        <?php } else { ?>
            <a class="nav-link" href="Login.php" style="color: #fff;">Log In</a>
        <?php } ?>
    </div>
</nav>
<style>
    .dashboard-container {
        text-align: center;
        background-color: #e7fae7;
        box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 20px;
        width: 80%;
        margin: 50px auto;

    }

    #serviceForm {
        display: none;
    }
    .folder-tab-container {
        position: relative;
        width: 100%;
        margin: auto;
        background-color: #e7fae7;
    }

    .dashboard-container {
        text-align: center;
        background-color: #e7fae7;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        width: 100%;
    }
    .profile-card {
        background-color: #f5f5f5;
        border: 1px solid #e6e6e6;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        margin: 20px auto;
        max-width: 600px;
        padding: 20px;
        text-align: left;
    }

    .profile-card h4 {
        color: #555;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .profile-card h5 {
        color: #888;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .tab-button {
        background-color: #25a141;
        color: #fff;
        border-radius: 5px;
        border: thin white;
        cursor: pointer;
    }
    .file-container {
        width: 600px;
        height: 200px;
        background-color: #fff;
        position: relative;
        margin: 20px auto;
    }

    .file-content {
        padding: 20px;
    }


</style>

<div class="profile-card">
    <div class="card-body">
        <h4 class="card-title">Athlete: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h4>
        <h5 class="card-subtitle mb-2 text-muted">Province: <?php echo $_SESSION['province']; ?></h5>
        <h5 class="card-subtitle mb-2 text-muted">Sport: <?php echo $_SESSION['sport']; ?></h5>
    </div>
</div>
<div class="file-container">
        <!-- Your content here -->
        <div class="folder-tab-container">

            <div class="dashboard-container">
                <!-- Add your dashboard content here -->
                <div id="serviceForm">
                    <h1>Book an Appointment</h1>
                    <p>Choose a service and preferred date and time to book your appointment. Please enter any special requests or concerns in the notes field.</p>
                    <form action="service/serviceprocess-booking.php" method="post" id="booking-form">
                        <div class="form-group">
                            <label for="service">Select a Service:</label>
                            <select name="service" id="service" required>
                                <option value="" disabled selected>Select a Service</option>
                                <option value="1">Mental Health Check</option>
                                <option value="2">Massage</option>
                                <option value="3">Doctor's Assessment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="preferred-time">Preferred Date and Time:</label>
                            <div class="form-inline">
                                <input type="date" min="2023-02-18" max="2023-03-05" class="form-control mr-3" name="date" id="date" required>
                                <select name="checkInTime" id="checkInTime" class="form-control" required>
                                    <?php
                    $start = strtotime("9:00 am");
                    $end = strtotime("10:00 pm");
                    $step = 30 * 60; // 30 minutes
                                    for ($time = $start; $time <= $end; $time += $step) {
                                        $period = date("g:i a", $time);
                                        echo "<option value='$period'>$period</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Special Requests or Concerns:</label>
                            <textarea class="form-control" name="note" id="note" ></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Book Appointment</button>
                            <a href="dashboardathlete.php" type="button" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
                <script>

                    function displayServiceForm() {
                        document.getElementById('serviceForm').style.display = 'block';
                        document.getElementById("tableOfResult").style.display = "none";
                    }

                    function closeDisplayTable() {
                        document.getElementById('tableOfResult').style.display = 'none';
                    }
                    function displayTable() {
                        document.getElementById('tableOfResult').style.display = 'block';
                        document.getElementById("serviceForm").style.display = "none";
                    }

                </script>
                <div id="tableOfResult">
                    <?php
                    $sort = " ORDER BY service_order.day, service_order.checkin_time ASC";
                    $query = "SELECT ord_Id as Num, day as Date, checkin_Time as Time, status as Status, service_Id as Services FROM service_order WHERE client_id = '{$_SESSION['clientId']}' $sort;";
                    $result = $mysqli->query($query);
                    $num_results = $result->num_rows;

                    if (isset($_GET['msg'])) {
                        echo "<p>{$_GET['msg']}</p>";
                    }
                    echo "<p>Number of orders found: $num_results</p>";
                    echo "<h4 style='color: brown'>Your Location: {$_SESSION['location']}</h4>";
                    echo "<h3>Upcoming Appointments</h3>";

                    if ($num_results > 0) {
                        $orders = $result->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <table class="table table-bordered table-striped" style="font-size: 14px;">
                            <thead>
                            <tr>
                                <?php
                                foreach ($orders[0] as $k => $v) {
                                    echo "<th>$k</th>";
                                }
                                ?>
                                <th>Function</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($orders as $order) {
                                $ord_Id = "";
                                echo "<tr>";
                                foreach ($order as $k => $v) {
                                    if ($k == "Services") {
                                        $services = [
                                            1 => "Mental Health Check",
                                            2 => "Doctor's Assessment",
                                            3 => "Physician",
                                            4 => "Nurse Practitioner",
                                            5 => "R Massage",
                                            6 => "Physiotherapist",
                                            7 => "Chiropractor",
                                            8 => "R Nurse",
                                            9 => "PT or AT",
                                            10 => "Reception"
                                        ];
                                        $v = $services[$v];
                                    }
                                    echo "<td>$v</td>";
                                    if ($k == "Num") {
                                        $ord_Id = $v;
                                    }
                                }
                                echo "<td>
                            <div class='btn-toolbar'>
                                <a href='Service/serviceEdit.php?ord_Id=$ord_Id' title='Edit Order' class='btn btn-info btn-xs' data-toggle='tooltip' style='font-size: 6px;'>Edit</a>
                                <a href='Service/serviceCancel.php?ord_Id=$ord_Id' title='Cancel Order' class='btn btn-info btn-xs' data-toggle='tooltip' style='font-size: 6px'>Cancel</a>
                            </div>
                          </td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "<h3 style='color: red'>You have no appointment booked!</h3>";
                    }
                    $result->free();
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
</div>

</div>
</body>
</html>
