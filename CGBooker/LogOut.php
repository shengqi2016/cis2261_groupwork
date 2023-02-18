<?php
session_start();
if($_SESSION["loggedIn"]){
    session_unset();
    session_destroy();
    header("location:Login.php");
}
?>
<a href="index.php">Go Back</a>
