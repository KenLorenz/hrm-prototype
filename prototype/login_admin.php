<!DOCTYPE html>
<html lang="en">

<?php
include_once('config/db.php');




?>


<head>
    <?php include('includes-regform/headassets.php') ?>
    <title>Repair/Upgrade Request</title> <!-- this php contains table view -->
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                
                <div class="card-heading">
                    <h2 class="title">Sign In</h2>
                </div>

                <div class="card-body">
                    <?php
                    
                    ?>
                    <form method="POST" action="error_login.php">

                        <div class="form-row">
                            <div class="name">Email:</div> <!-- This will be used for acquiring the department as well as employee involved -->
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                    <label class="label--desc">Enter your company email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row"> <!-- Max will depend on Department table floor column (new column) -->
                            <div class="name">Password:</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="password" class="input--style-5" name="password" required>
                                    <label class="label--desc">Enter your Company Email's Password</label>
                                </div>
                            </div>
                        </div>

                        
                        <div>
                            <button class="btn btn--radius-2 btn--green" style="margin-top: 50px;" type="submit" value="submit" name="submit">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes-regform/bodyassets.php') ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->