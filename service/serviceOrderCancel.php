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
        $ordId = $_GET['ordId'];


        $query = "UPDATE service_order SET status = 'canceled' WHERE ord_Id = '" . $ordId ."';";

        // Here we use our $db object created above and run the query() method. We pass it our query from above.

        $result = $mysqli->query($query);

        //$num_results = $result->num_rows;

        if (isset($_GET['msg'])) {
            echo "<p>{$_GET['msg']}</p>";
        }






        if ($result) {

            echo "<h3>The service order canceled successfully</h3>";

        }else{
            $query = "UPDATE service_order SET status = 'confirmed' WHERE ord_Id = '" . $ordId ."';";
            $result = $mysqli->query($query);
            echo "<h3>The service order canceled failed</h3>";


        }


        ?>


    </div>

</body>



<?php
