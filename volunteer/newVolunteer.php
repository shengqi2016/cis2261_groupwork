<!DOCTYPE html>
<html>
<head>
    <title>Add New Volunteer</title>
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
            <h2 class="text-left" id="titleOfAddVolunteer">Add New Volunteer</h2>
            <form method="post" action="newVolunteer-process.php">
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
                            <label for="specialty">Specialty</label>
                            <select class="form-control" id="specialty" name="specialty" required>
                                <?php
                                $specialties = array("Mental Health Check description", "Doctor's Assessment description",
                                    "Physician", "Nurse Practioner", "R Massage", "Physiotherapist", "Chripractor", "R Nurse",
                                    "PT or AT", "Reception");
                                foreach ($specialties as $specialty) {
                                    echo "<option value='$specialty'>$specialty</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="note">Note</label>
                            <br>
                            <input type="text" name="note" id="note" maxlength="250" value="">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">

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
