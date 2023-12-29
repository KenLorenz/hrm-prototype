<!DOCTYPE html>
<html lang="en">


<?php
    

require('config/db.php');





# This table should only include Finished requests.
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
                                    <h4 class="card-title">Feedback & Requests Analytics</h4> <!-- only includes approved requests -->
                                    <p class="card-category">Annual frequency chart (Approved Requests)</p>
                                </div>
                                
                                <div class="card-body ">
                                    <h4 class="card-title" style="text-align: center;">Total Repair Request Chart</h4>
                                    <canvas id="repair-frequency"></canvas>

                                    <h4 class="card-title" style="text-align: center;">Total Upgrade Request Chart</h4>
                                    <canvas id="upgrade-frequency"></canvas>
                                    <?php
                                        $sql = "SELECT DATE_FORMAT(date_issued, '%Y') as year, count(idmaintenance_type) as total_type # year, total_type, # for first chart
                                        FROM maintenance WHERE idmaintenance_type = 2 and idmaintenance_status = 3
                                        GROUP BY DATE_FORMAT(date_issued, '%Y') ORDER BY year asc;";
                                
                                        $result = mysqli_query($conn,$sql);
                                        
                                        
                                        if(mysqli_num_rows($result) > 0){
                                            $year = array();
                                            $total_type = array();
                                            while($row = mysqli_fetch_array($result)){
                                                $year[] = $row['year'];
                                                $total_type[] = $row['total_type'];
                                            }
                                        } else {
                                            echo "No records found.";
                                        }

                                        # 
                                        $sql2 = "SELECT DATE_FORMAT(date_issued, '%Y') as year, count(idmaintenance_type) as total_type # year, total_type, # for first chart
                                        FROM maintenance WHERE idmaintenance_type = 1 and idmaintenance_status = 3
                                        GROUP BY DATE_FORMAT(date_issued, '%Y') ORDER BY year asc;";
                                
                                        $result2 = mysqli_query($conn,$sql2);
                                        
                                        
                                        if(mysqli_num_rows($result2) > 0){ # fix later
                                            $year2 = array();
                                            $total_type2 = array();
                                            while($row = mysqli_fetch_array($result2)){
                                                $year2[] = $row['year'];
                                                $total_type2[] = $row['total_type'];
                                            }
                                        } else {
                                            echo "No records found.";
                                        }
                                        
                                        mysqli_free_result($result);
                                        mysqli_free_result($result2);

                                        mysqli_close($conn);
                                    ?>

                                    

                                    <script>
                                        
                                        // Repair chart

                                        const year2 = <?php echo json_encode($year2); ?>;
                                        const total_type2 = <?php echo json_encode($total_type2); ?>;

                                        const data2 = {
                                            labels: year2,
                                            datasets: [{
                                                label: 'Total Repair Request Per Year',
                                                data: total_type2,
                                                backgroundColor: [
                                                    'rgb(100,99,255)',
                                                ]
                                            }
                                            ]
                                        };
                                        
                                        const config2 = {
                                            type: 'line',
                                            data: data2,
                                            options: {
                                                indexAxis: 'x',
                                            }
                                        };

                                        const upgradeFrequency = new Chart(
                                            document.getElementById('repair-frequency'),
                                            config2
                                        );

                                        // Upgrade chart

                                        const year = <?php echo json_encode($year); ?>;
                                        const total_type = <?php echo json_encode($total_type); ?>;

                                        const data1 = {
                                            labels: year,
                                            datasets: [{
                                                label: 'Total Upgrade Request Per Year',
                                                data: total_type,
                                                backgroundColor: [
                                                    'rgb(100,255,132)',
                                                ]
                                            }
                                            ]
                                        };
                                        

                                        

                                        const config1 = {
                                            type: 'line',
                                            data: data1,
                                            options: {
                                                indexAxis: 'x',
                                                plugin: {
                                                    legend: {
                                                        display: false,
                                                    }
                                                }
                                            },
                                        };

                                        const repairFrequency = new Chart(
                                            document.getElementById('upgrade-frequency'),
                                            config1
                                        );

                                    </script>
                                </div>
                            </div>
                        </div>





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
