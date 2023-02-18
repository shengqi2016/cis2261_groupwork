<?php
include("DataBase/config.php");
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
    $query = "SELECT coachOrAthlete FROM client WHERE BINARY email='".$_SESSION["username"] ."'";
    $result = $mysqli->query($query);
    if (!$result) {
        die('Query failed: ' . $mysqli->error);
    }
    $row = $result->fetch_assoc();
    if ($row) {
        $formOfRole = $row["coachOrAthlete"];
        if ($formOfRole == "1") {
            header("location:dashboardcoach.php");
            exit;
        } else if ($formOfRole == "0") {
            header("location:dashboardathlete.php");
            exit;
        }
    } else {
//        echo "No results found.";
    }
}