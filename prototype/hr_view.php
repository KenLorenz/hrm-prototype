<!DOCTYPE html>
<html lang="en">


<?php
    
/* require('config/config.php');
require('config/db.php'); */
    
# its HR analysis for approved specifically, separatedly for fix and upgrade, and both.
?>


<head>
    <?php include('includes-bootstrap/headassets.php') ?>
</head>
<body>
    
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">1
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
                                    <h4 class="card-title">Feedback & Requests History</h4>
                                    <p class="card-category">Repair & Upgrade Request Logs</p>
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
                                            <tr> 
                                                <td>Ken Lorenz</td>
                                                <td>imageFORMULA DR-C225 II</td>
                                                <td>Repair</td>
                                                <td>Phoenix Graphics Inc.</td>
                                                <td>1</td>
                                                <td>25 Dec 2023</td>
                                                <td>Completed</td>
                                                <td><a href="manage.php?id="><button>Manage</button></a></td> <!-- pressing a specific row opens a new page for a more detailed and organized form. -->
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                        for($page = 1; $page <= $number_of_page; $page++){
                            echo '<a href="employee.php?page=1'. $page . '">' . $page . '</a>'; /* note */
                        }?>
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
