<!DOCTYPE html>
<html lang="en">

<?php
include('config/db.php');

if(isset($_POST['submit_request'])){ # fix later
    $email = $_POST['email'];
    $floor = $_POST['floor'];
    $device = $_POST['device'];
    $feedback = $_POST['feedback'];
    $type = $_POST['type'];
    $status = 1;
    $date_issued = date("Y-m-d H:i:s");

    $sql = "SELECT employees_idemployees from access where company_email = '$email';";
    $results = mysqli_query($conn,$sql);
    $idemployees = mysqli_fetch_all($results,MYSQLI_ASSOC);

    if (count($idemployees) < 1){ // test
        header("Location: error_index.php");
        return;
    }

    $sql = "INSERT INTO maintenance(`idmaintenance_status`,`idmaintenance_type`,`date_issued`,`issued_feedback`,`device`) 
            VALUES(?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn,$sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "iisss", $status, $type, $date_issued, $feedback, $device);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo mysqli_error($conn);
    }

    $idmaintenance = mysqli_insert_id($conn);

    $sql = "INSERT INTO devices_has_maintenance(`devices_iddevices`,`maintenance_idmaintenance`) 
    VALUES(?,?)";

    $stmt = mysqli_prepare($conn,$sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "ii", $device, $idmaintenance);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo mysqli_error($conn);
    }

    
    $sql = "SELECT departments_iddepartments FROM employees_unitassignments WHERE employees_idemployees = ".$idemployees[0]['employees_idemployees'];
    $results = mysqli_query($conn,$sql);
    $iddepartments = mysqli_fetch_all($results,MYSQLI_ASSOC);
    $iddepartments = $iddepartments[0]['departments_iddepartments'];

    $sql = "INSERT INTO employees_unitassignments_has_repairs(`idmaintenance`,`iddepartments`,`idemployees_issued`,`department_floor`) 
    VALUES(?,?,?,?)";

    $stmt = mysqli_prepare($conn,$sql);

    $idemployees_issued = $idemployees[0]['idemployees'];
    if($stmt){
        mysqli_stmt_bind_param($stmt, "iiii", $idmaintenance, $iddepartments, $idemployees[0]['employees_idemployees'], $floor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo mysqli_error($conn);
    }
    header("Location: success_index.php");
}


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
                                    <input class="input--style-5" type="email" name="email" required>
                                    <label class="label--desc">Enter your company email</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row"> <!-- Max will depend on Department table floor column (new column) -->
                            <div class="name">Department Floor:</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="Number" class="input--style-5" type="text" name="floor" min="1" max="10" required value="1">
                                    <label class="label--desc">Enter your assigned department floor</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row"> <!-- This option assumes that a company has a table specifically for devices that uses. -->
                            <div class="name">Device: </div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="device" required>

                                            <?php
                                            $query = "SELECT * FROM devices";
                                            $result = mysqli_query($conn,$query);
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<option value=". $row['iddevices'] . ">" . $row['name'] . '</option>';
                                            }
                                            ?>
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
                                <textarea class="input--style-5" style="width: 100%; resize: none;" name="feedback" required></textarea>
                                    <label type="Text" class="label--desc">Enter your detailed feedback</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row p-t-20">
                            <label class="label label--block">Request Type:</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Repair
                                    <input type="radio" checked="checked" name="type" value="1">
                                    <span class="checkmark"></span>
                                </label>

                                <label class="radio-container">Upgrade
                                    <input type="radio" name="type" value="2">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </div>
                        
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit" name="submit_request" value="submit_request">Submit Form</button>
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