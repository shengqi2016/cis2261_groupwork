<?php
/*Author: Qi Sheng
 *Date:1/16/2023
 * Description: Login page of The Games
 */

session_start();
$msg ='';
?>
<!doctype html>
<html>
<head>
    <title>The Games Staff Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/TheGamesLayOut.css">
    <style>
        #container {
            width: 30%;
            margin: 50px auto;
            font-family: "Times New Roman";
            background-color: darkseagreen;
            padding: 50px;
            border-radius: 25px;
            border: 2px solid white;
        }

    </style>

</head>
<body>
<div id="container" style="width: 80%;margin: auto" >
    <div class="login-form">
        <form action="login.php" method="post">
            <h2 class="text-center" id="titleOfLoginIn">The Games Staff Log In</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" placeholder="Email Address" required="required">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                <h3 style="color:red;"><?php  if(isset($_GET['msg'])){
                    echo $_GET['msg']; } ?></h3></div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-block" id="defaultButton">Log in</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
include("DataBase/config.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
//Getting the username/email from the database to check the password
    $query = "SELECT email FROM account WHERE BINARY email='" . $username . "' AND password='" . $password . "'";
    $result = $mysqli->query($query);

    if ($result == $mysqli->query($query)) {
//check the correction
        if ($result->num_rows == 1) {
            echo " your username or password is correct";
            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;
            //get the email from the account table and get the role from the client table by email
            $row = mysqli_fetch_assoc($result);
            $searchingRole = $row["email"];
            //get the role of the username/email
            $query = "SELECT specialty FROM staff WHERE BINARY email='" . $searchingRole . "'";
            $result = $mysqli->query($query);
            $row = mysqli_fetch_assoc($result);
            $formOfRole = $row["specialty"];
            if ($formOfRole == "Admin") {
                header("location:dashboardadmin.php");
                exit;
            } else {
                header("location:dashboardvolunteer.php");
                exit;
            }

    //The form depends on the role
    // Need adding
        } else {
            $msg= "Your username or password is wrong";
            $_SESSION["loggedIn"] = false;
            header("location:Login.php?msg= $msg");
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }

}


?>
