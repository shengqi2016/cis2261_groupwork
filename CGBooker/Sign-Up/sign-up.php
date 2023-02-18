<!DOCTYPE html>
<html>
<head>
    <title>Sign Up!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/TheGamesLayOut.css">

    </style>
</head>
<body>
<div class="fancyContainer">
    <div class="box">
        <div class="content">
            <!-- Your content goes here -->
            <h2 class="text-left" id="titleOfLoginIn">Sign Up</h2>
    <form method="post" action="signup-process.php">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName"  placeholder="First Name"required>
                </div>
                <div class="col-md-6">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="col-md-6">
                    <label for="phoneNumber">Phone Number (optional)</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" >
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="sport">Sport</label>
                    <select class="form-control" id="sport" name="sport" required>
                        <?php
                        $sports = array("Alpine Skiing", "Archery", "Badminton", "Biathlon", "Boxing", "Cross-country Skiing", "Curling", "Fencing", "Figure Skating", "Freestyle Skiing", "Gymnastics", "Ice Hockey", "Judo", "Karate", "Ringette", "Snowboarding", "Speed Skating", "Squash", "Table Tennis", "Wheelchair Basketball");
                        foreach ($sports as $sport) {
                            echo "<option value='$sport'>$sport</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="province">Province</label>
                    <select class="form-control" id="province" name="province" required>
                        <?php
                        $provinces = array('Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon Territory');
                        $abbreviation=array("AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT");
                        $order=0;
                        foreach ($provinces as $province) {

                            echo "<option value='$abbreviation[$order]'>$province</option>";
                            $order++;
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="role" >Which describes you best?</label>
                    <div>
                        <input type="radio" id="athlete" name="role" value=0 required>
                        <label for="athlete">Athlete</label>
                        <br>
                        <input type="radio" id="coach" name="role" value=1 required>
                        <label for="coach">Coach</label>
                        <br>

                    </div>
                </div>
                <!--changed input type to password
                TODO validate password-->
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" name="submit" class="btn btn-primary" id="defaultButton">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
