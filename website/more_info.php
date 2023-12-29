
<!DOCTYPE html>
<html>

<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_admin.php");
    exit;
}

include('config/db.php');
$id = $_GET['id'];

$sql = "SELECT m.idmaintenance,e.idemployees_issued, d.devices_iddevices, m.idmaintenance_type, e.iddepartments, e.department_floor, m.date_issued, m.idmaintenance_status, m.issued_feedback
    from maintenance as m 
    inner join employees_unitassignments_has_repairs as e on e.idmaintenance = m.idmaintenance
    inner join devices_has_maintenance as d on d.maintenance_idmaintenance = m.idmaintenance WHERE m.idmaintenance = " . $id;

$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


$sql = "SELECT concat(first_name, ' ',last_name) as full_name FROM employees WHERE idemployees = " . $rows[0]['idemployees_issued'] . ";";
$employee_issued = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

$sql = "SELECT name FROM devices WHERE iddevices = ".$rows[0]['devices_iddevices'].";";
$device = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

$sql = "SELECT maintenance_name FROM maintenance_type WHERE idmaintenance_type = ".$rows[0]['idmaintenance_type'].";";
$type = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

$sql = "SELECT dept_name FROM departments WHERE iddepartments = ".$rows[0]['iddepartments'].";";
$department_name = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

if(isset($_POST['submit_more_info'])){ # for more_info.php POST response

    $status_change = "2"; # from awaiting for approval to ongoing.
    $sql = "UPDATE maintenance SET idmaintenance_status = $status_change WHERE idmaintenance = $id;";

    $query = mysqli_query($conn, $sql);

     
    $sql = "UPDATE employees_unitassignments_has_repairs SET idemployees_repairer = " . $_SESSION['user_id'] . " WHERE idmaintenance = $id;"; # this something is acquisitioned from login data.

    $query = mysqli_query($conn, $sql);
    
    
    header("Location: request_view.php");
}
mysqli_free_result($result);
mysqli_close($conn);

?>

<head>
    <?php include('includes-bootstrap/headassets.php') ?>
    <title>Request Manage</title>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">

            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php'); ?>
                
            </div>

        </div>
        <div class="main-panel">
            <?php include('includes/navbar.php') ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Request Information</h4>
                                </div>
                                <div class="card-body">
                                    
                                    <form method="POST" action="">

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>Employee</label>
                                                    <input type="text" class="form-control" name="documentcode" value="<?php echo $employee_issued[0]['full_name'] ?>" readonly>
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control" name="documentcode" value="<?php echo $department_name[0]['dept_name'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 pr-5">
                                                <div class="form-group">
                                                    <label>Floor</label>
                                                    <input type="text" class="form-control" name="documentcode" value="<?php echo $rows[0]['department_floor'] ?>" readonly>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-5">
                                                <div class="form-group">
                                                    <label>Device</label>
                                                    <input type="text" class="form-control" name="documentcode" value="<?php echo $device[0]['name'] ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>Employee Feedback</label>
                                                    <textarea class="form-control" name="" readonly><?php echo $rows[0]['issued_feedback'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>It will be assigned to you:</label>
                                                    <input type="text" class="form-control" name="documentcode" value="<?php echo $_SESSION['user_id'] ?>" readonly>
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <a href="request_view.php" class="btn btn-info btn-fill pull-right" style="margin: 5px;">Go Back</a>
                                        <button type="submit" name="submit_more_info" value="submit_more_info" class="btn btn-info btn-fill pull-right" style="margin: 5px;">Assign Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php include('includes-bootstrap/bodyassets.php') ?>
    <footer class="footer">
        <div class="container-fluid">
            <nav>
                <ul class="footer-menu">
                    <li>
                        <a href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Company
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Blog
                        </a>
                    </li>
                </ul>
                <p class="copyright text-center">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </nav>
        </div>
    </footer>
</body>
</html>
