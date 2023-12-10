
<!DOCTYPE html>
<html>

<?php



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
                                    
                                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Employee</label>
                                                    <input type="text" class="form-control" name="documentcode" value="Ken Lorenz Sendaydiego" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Current Status</label>
                                                    <input type="text" class="form-control" name="documentcode" value="Ongoing" readonly>
                                                </div>
                                            </div>

                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control" name="documentcode" value="Phoenix Graphics Inc." readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-3 pr-5">
                                                <div class="form-group">
                                                    <label>Floor</label>
                                                    <input type="text" class="form-control" name="documentcode" value="2" readonly>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 pr-5">
                                                <div class="form-group">
                                                    <label>Device</label>
                                                    <input type="text" class="form-control" name="documentcode" value="imageFORMULA DR-C225 II" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>Employee Feedback</label>
                                                    <textarea class="form-control" name="" readonly>Does not power on, no light indication that it is on even when plugged</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-10 pr-1">
                                                <div class="form-group">
                                                    <label>Status Update Response</label>
                                                    <textarea class="form-control" name="" required> </textarea> <!-- Repairer must deliver a response -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 px-1">
                                                <div class="form-group">
                                                    <label>Update Status</label>
                                                    <select class="form-control" name="action" required>

                                                        <option>Completed</option>
                                                        <option>Denied</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="request_view.php"><button class="btn btn-info btn-fill pull-right" style="margin: 5px;">Go Back</button></a>
                                        <button type="submit" name="submit" value="Submit" class="btn btn-info btn-fill pull-right" style="margin: 5px;">Update & Conclude Status</button>
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
