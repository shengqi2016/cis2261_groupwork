<?php
session_start();
if (!isset($_SESSION["loggedIn"])){
//    echo '<script>alert("sessionChecked")</script>';
    $_SESSION["loggedIn"]=false;
}
if(!isset( $_SESSION["username"])){
    $_SESSION["username"]='';
}
if(!isset( $_SESSION['firstname'])){
    $_SESSION['firstname']='';
}
if(!isset( $_SESSION['lastname'])){
    $_SESSION['lastname']='';
}
//if(!isset( $_SESSION['province'])){
//    $_SESSION['province']='';
//}
//if(!isset( $_SESSION['location'])){
//    $_SESSION['location']='';
//}
//if(!isset( $_SESSION['roomNum'])){
//    $_SESSION['roomNum']='';
//}

