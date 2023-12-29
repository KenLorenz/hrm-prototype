<!DOCTYPE html>
<html lang="en">


<?php
    
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION = [];
    header("Location: login_admin.php");
    exit;
}
require('config/db.php');
$user_id = $_SESSION['user_id'];

$sql = "SELECT m.idmaintenance,e.idemployees_issued, d.devices_iddevices, m.idmaintenance_type, e.iddepartments, e.department_floor, m.date_issued, m.idmaintenance_status, e.idemployees_repairer
    from maintenance as m
    inner join employees_unitassignments_has_repairs as e on e.idmaintenance = m.idmaintenance
    inner join devices_has_maintenance as d on d.maintenance_idmaintenance = m.idmaintenance
    WHERE e.idemployees_repairer = $user_id
    ORDER BY m.idmaintenance_status asc;";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);



# mysqli_close($conn);
# This table should only include Finished requests.
?>


<head>
    <?php include('includes-bootstrap/headassets.php') ?>
</head>
<body>
    
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
            -->
            <div class="sidebar-wrapper">
                <?php include('includes/sidebar.php'); ?>
                <!-- 1 -->
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
                            <div class="card strpied-tabled-with-hover">
                            <br/>


                                <div class="card-header ">
                                    <h4 class="card-title">Feedback & Requests Assigned</h4>
                                    <p class="card-category">Repair & Upgrade Ongoing Requests</p>
                                </div>
                                <div class="card-header ">
                                    
                                    <?php
                                    
                                    ?>
                                    <p class="card-category">Total: <?php echo mysqli_num_rows($result); ?></p>
                                    <?php mysqli_free_result($result); ?>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Issued by</th>
                                            <th>Device</th>
                                            <th>Request Type</th>
                                            <th>Department</th>
                                            <th>Floor</th> <!-- Department Floor -->
                                            <th>Date</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody> <!-- if no ongoing requests, it should echo a description -->
                                            <?php foreach($rows as $x): ?>
                                            <?php

                                            if($x['idmaintenance_status'] == 2):
                                            $sql = "SELECT concat(first_name, ' ',last_name) as full_name FROM employees WHERE idemployees = " . $x['idemployees_issued'] . ";";
                                            $employee_issued = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
                                            
                                            $sql = "SELECT name FROM devices WHERE iddevices = ".$x['devices_iddevices'].";";
                                            $device = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

                                            $sql = "SELECT maintenance_name FROM maintenance_type WHERE idmaintenance_type = ".$x['idmaintenance_type'].";";
                                            $type = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

                                            $sql = "SELECT dept_name FROM departments WHERE iddepartments = ".$x['iddepartments'].";";
                                            $department_name = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

                                            $sql = "SELECT status_name FROM maintenance_status WHERE idmaintenance_status = ".$x['idmaintenance_status'].";";
                                            $status = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
                                            ?>
                                            <tr> 
                                                <td><?php echo $employee_issued[0]['full_name']; ?></td>
                                                <td><?php echo $device[0]['name']; ?></td>
                                                <td><?php echo $type[0]['maintenance_name']; ?></td>
                                                <td><?php echo $department_name[0]['dept_name']; ?></td>
                                                <td><?php echo $x['department_floor']; ?></td>
                                                <td><?php echo $x['date_issued']; ?></td>
                                                <td><?php echo $status[0]['status_name']; ?></td>
                                                <td><a href="manage.php?id=<?php echo $x['idmaintenance']; ?>"><button>Manage</button></a></td> <!-- pressing a specific row opens a new page for a more detailed and organized form. -->
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; mysqli_free_result($result); mysqli_close($conn);?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- space -->
                    </div>
                </div>
            </div>
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
        </div>
    </div>
    
    <?php include('includes-bootstrap/bodyassets.php') ?>
</body>


</html>
