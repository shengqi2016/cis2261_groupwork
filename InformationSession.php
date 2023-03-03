<?php
$query = "SELECT first_Name FROM staff WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$first_Name = $row["first_Name"];
$_SESSION['firstname']=$first_Name;//firstname

$query = "SELECT last_Name FROM staff WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$last_Name = $row["last_Name"]; //lastname
$_SESSION['lastname']=$last_Name;

$query = "SELECT employee_Num FROM staff WHERE BINARY email='" . $_SESSION['username'] . "'";
$result = $mysqli->query($query);
$row = mysqli_fetch_assoc($result);
$employee_Num = $row["employee_Num"]; //lastname
$_SESSION['employee_Num']=$employee_Num;

//$query = "SELECT province FROM client WHERE BINARY email='" . $_SESSION['username'] . "'";
//$result = $mysqli->query($query);
//$row = mysqli_fetch_assoc($result);
//$province = $row["province"];
//$_SESSION['province']=$province;
//
//$query = "SELECT location FROM room WHERE BINARY province='" . $_SESSION['province'] . "'";
//$result = $mysqli->query($query);
//$row = mysqli_fetch_assoc($result);
//$location = $row["location"];
//$_SESSION['location']=$location;
//
//$query = "SELECT room_Num FROM room WHERE BINARY province='" . $_SESSION['province'] . "'";
//$result = $mysqli->query($query);
//$row = mysqli_fetch_assoc($result);
//$roomNum = $row["room_Num"];
//$_SESSION['roomNum']=$roomNum;
//
//$query = "SELECT segment_Description FROM segment";
//
//$result = $mysqli->query($query);
//$row = mysqli_fetch_all($result);
//$_SESSION['segmentPeriod']=$row;
