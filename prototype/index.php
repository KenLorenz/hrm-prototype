<!DOCTYPE html>
<html lang="en">

<?php




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
                    <h2 class="title">Repair & Upgrade Request Form</h2>
                </div>

                <div class="card-body">
                    <form method="POST">

                        <div class="form-row">
                            <div class="name">Email:</div> <!-- This will be used for acquiring the department as well as employee involved -->
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="company" required>
                                    <label class="label--desc">Enter your company email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row"> <!-- Max will depend on Department table floor column (new column) -->
                            <div class="name">Department Floor:</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="Number" class="input--style-5" type="text" name="company" min="1" max="10"  required>
                                    <label class="label--desc">Enter your assigned department floor</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row"> <!-- This option assumes that a company has a table specifically for devices that uses. -->
                            <div class="name">Device: </div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="subject" required>
                                            <option>OptiPlex 7050</option> <!-- PC -->
                                            <option>imageFORMULA DR-C225 II</option> <!-- Scanner -->
                                            <option>PowerLite 1781W</option> <!-- Projector -->
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Feedback</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                    <label type="Text" class="label--desc">Enter your detailed feedback</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row p-t-20">
                            <label class="label label--block">Request Type:</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Repair
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>

                                <label class="radio-container">Upgrade
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </div>
                        
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
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