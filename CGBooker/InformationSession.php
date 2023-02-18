<?php
$query = "SELECT first_Name FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$first_Name = $row["first_Name"];
$_SESSION['firstname']=$first_Name;//firstname

$query = "SELECT last_Name FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$last_Name = $row["last_Name"]; //lastname
$_SESSION['lastname']=$last_Name;

$query = "SELECT province FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$province = $row["province"];
$_SESSION['province']=$province;

$query = "SELECT location FROM room WHERE BINARY province='" . $_SESSION['province'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$location = $row["location"];
$_SESSION['location']=$location;

$query = "SELECT room_Num FROM room WHERE BINARY province='" . $_SESSION['province'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$roomNum = $row["room_Num"];
$_SESSION['roomNum']=$roomNum;

$query = "SELECT segment_Description FROM segment";
$result = $mysqli->query($query);
$row = mysqli_fetch_all($result);
$_SESSION['segmentPeriod']=$row;

$query = "SELECT client_Id FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$clientId = $row["client_Id"];
$_SESSION['clientId']=$clientId;

$query = "SELECT sport FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$sport = $row["sport"];
$_SESSION['sport']=$sport;//firstname