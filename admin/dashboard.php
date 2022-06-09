<?php
    include 'connection.php';
    include 'login-check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart Js script -->
    <title>Dashboard - WeCycle</title>

    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <?php
        $qryStuCount = "SELECT * FROM tbl_student";
        $resStuCount = mysqli_query($conn, $qryStuCount);
        $UserCount = mysqli_num_rows($resStuCount);

        $qryBikeCount= "SELECT * FROM tbl_bicycle";
        $resBikeCount= mysqli_query($conn,$qryBikeCount);
        $BikeCount = mysqli_num_rows($resBikeCount);

        $qryRideCount= "SELECT COUNT(id) AS Total,
                                COUNT(case when status='On-going' then 1 end) AS ActiveRides
                                FROM tbl_rides";
        $resRideCount= mysqli_query($conn, $qryRideCount);
        while($cnt = mysqli_fetch_assoc($resRideCount))
        {
            $totalRideCount = $cnt['Total'];
            $activeRideCount= $cnt['ActiveRides'];
        }

        
        
    ?>
</head>
<body>
    <!-- Start - Background -->
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <!-- End - Background -->
    
    <div class="container-xxl position-relative bg-none d-flex p-0" style="max-width: 1350px;">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <a href="dashboard.php">
                <div class="toplogo bg-white">
                    <div>
                        <img src="images/logo-with-white-bg.png" alt="" style="width: 200px;">
                    </div>
                </div>
            </a>
            <nav class="navbar navbar-light">
                    <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bicycle me-2"></i>Rides</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="upcoming-rides.php" class="dropdown-item"><i class="far fa-file-alt me-2"></i>Upcoming Rides</a>
                            <a href="activerides.php" class="dropdown-item"><i class="far fa-file-alt me-2"></i>Active Rides</a>
                            <a href="Completed-rides.php" class="dropdown-item"><i class="far fa-file-alt me-2"></i>Completed Rides</a>
                            <a href="todayrides.php" class="dropdown-item"><i class="far fa-file-alt me-2"></i>Today Rides</a>
                            <a href="totalrides.php" class="dropdown-item"><i class="far fa-file-alt me-2"></i>Total Rides</a>

                        </div>
                    </div>
                    <a href="map.php" class="nav-item nav-link"><i class="fa fa-map me-2"></i>Map</a>                
                <a href="bicycles.php" class="nav-item nav-link"><i class="fa fa-bicycle me-2"></i>Bicycles</a>
                <a href="reg-students.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Students</a>
                <a href="admin-users.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Admin Users</a>
                
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand casebox bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0" style="color: #19589D;">
                    <i class="fa fa-bars" style="color: white;"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="images/pro-pic.png" alt="Profile Pic" style="width: 40px; height: 40px;">
                            <span class="user d-none d-lg-inline-flex"><?php echo $_SESSION['user'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0">
                            <a href="profile.php" class="dropdown-item">Profile</a>
                            <a href="log-out.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Rides Panel Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="casebox bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <a href="reg-students.php">
                            <i class="fa fa-user fa-3x text-primary"></i>
                            <div class="ms-3">
                                    <p class="cases mb-2">Users-<?php echo $UserCount ?></p>
                                </a>    
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="casebox bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <a href="bicycles.php">
                            <i class="fa fa-bicycle fa-3x text-primary"></i>
                            <div class="ms-3">
                                    <p class="cases mb-2">Bicycles-<?php echo $BikeCount ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="casebox bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <a href="activerides.php">
                            <i class="fa fa-circle fa-3x text-primary"></i>
                            <div class="ms-3">
                                    <p class="cases mb-2">Active Rides-<?php echo $activeRideCount ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="casebox bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <a href="totalrides.php">
                            <i class="fa fa-check-circle fa-3x text-primary"></i>
                            <div class="ms-3">
                                    <p class="cases mb-2">Total Rides-<?php echo $totalRideCount ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rides Panel End -->


            <!-- Rides Boxes Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="casebox bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Recent Users</h6>
                            </div>
                            <div class="caseboxtable table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <tbody>
                                        <?php
                                            $qryRecentUser = "SELECT * FROM tbl_rides 
                                                                    INNER JOIN tbl_student 
                                                                    ON tbl_rides.stu_id = tbl_student.stu_id 
                                                                    WHERE DATE(date_time) = CURDATE()
                                                                    ORDER BY id";
                                            $resRecentUser = mysqli_query($conn, $qryRecentUser);
                                            if(mysqli_num_rows($resRecentUser)>0)
                                            {
                                                while($rows = mysqli_fetch_assoc($resRecentUser))
                                                {
                                                    $bookingid = $rows['id'];
                                                    $stu_id = $rows['stu_id'];

                                                    $datetimeValue = $rows['date_time'];
                                                    $datetime = new DateTime($datetimeValue);
                                                        $date = $datetime->format('Y-m-d');
                                                        $time = $datetime->format('H:i:s');
                                                    $status = $rows['status'];
                                                    $location = $rows['start_location'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $stu_id ?></td>
                                                    <td><?php echo $date ?></td>
                                                    <td><?php echo $time ?></td>
                                                    <td><?php echo $location ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="user-details.php?studId=<?php echo $stu_id ?>">Details</a></td>
                                                </tr>

                                                <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="casebox bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Recently Used Bicycles</h6>
                            </div>
                            <div class="caseboxtable table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <tbody>
                                    <?php
                                            $qryRecentUsedBike = "SELECT * FROM tbl_rides 
                                                                    INNER JOIN tbl_bicycle 
                                                                    ON tbl_rides.bicycle_id = tbl_bicycle.id
                                                                    WHERE DATE(date_time) = CURDATE()
                                                                    ORDER BY tbl_bicycle.id";
                                            $resRecentUsedBike = mysqli_query($conn, $qryRecentUsedBike);
                                            if(mysqli_num_rows($resRecentUsedBike)>0)
                                            {
                                                while($rows = mysqli_fetch_assoc($resRecentUsedBike))
                                                {
                                                    $bikeId = $rows['id'];
                                                    $datetimeValue = $rows['date_time'];
                                                    $datetime = new DateTime($datetimeValue);
                                                        $date = $datetime->format('Y-m-d');
                                                        $time = $datetime->format('H:i:s');
                                                    $location = $rows['start_location'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $bikeId ?></td>
                                                    <td><?php echo $date ?></td>
                                                    <td><?php echo $time ?></td>
                                                    <td><?php echo $location ?></td>
                                                    <td><a class="btn btn-sm btn-primary" href="bicycle-details.php?BikeId=<?php echo $bikeId ?>">Details</a></td>
                                                </tr>

                                                <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rides Boxes End -->

            <!-- Rides Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <!-- Weekly Rides php -->
                    <?php 
                        $sqlMultiBarWeekly = "SELECT
                                    DAY(start_date_time) AS Week,
                                    COUNT(case when status='Completed' then 1 end) AS Completed,
                                    COUNT(case when status='Cancelled' then 1 end) AS Cancelled,
                                    COUNT(case when status='Upcoming' then 1 end) AS Upcoming,
                                    COUNT(*) as Total_Rides
                                FROM tbl_rides
                                GROUP BY DAY(start_date_time);";
                        $res = mysqli_query($conn, $sqlMultiBarWeekly);
                        foreach($res as $data)
                        {
                            $week[] = $data['Week'];
                            $Completedamount[] = $data['Completed'];
                            $Cancelledamount[] = $data['Cancelled'];
                            $Upcomingamount[] = $data['Upcoming'];
                            $TotalRideamount[] = $data['Total_Rides'];
                        }
                    ?>
                        <div class="casebox bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Weekly</h6>
                            </div>
                            <canvas id="myWeeklyMultiBarChart"></canvas>
                        </div>

                    <!-- Weekly Rides Script -->
                    <script>
                        const labelsMultiBar = <?php echo json_encode($week) ?>;
                        const dataMultiBar = {
                            labels: labelsMultiBar,
                            datasets: [{
                            label: 'Completed Rides',
                            data: <?php echo json_encode($Completedamount) ?>,
                            backgroundColor: 'rgba(255, 99, 132, 0.4)',
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1
                            },{
                            label: 'Cancelled Rides',
                            data: <?php echo json_encode($Cancelledamount) ?>,
                            backgroundColor: 'rgba(255, 159, 64, 0.4)',
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                            },{
                            label: 'Upcoming Rides',
                            data: <?php echo json_encode($Upcomingamount) ?>,
                            backgroundColor: 'rgba(255, 153, 255, 0.4)',
                            borderColor: 'rgb(255, 153, 255)',
                            borderWidth: 1
                            },{
                            label: 'Total Rides',
                            data: <?php echo json_encode($TotalRideamount) ?>,
                            backgroundColor:'rgba(51, 153, 255, 0.4)',
                            borderColor: 'rgb(51, 153, 255)',
                            borderWidth: 1
                            }]
                        };

                        const configMultiBar = {
                            type: 'bar',
                            data: dataMultiBar,
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            },
                        };

                        var myMultiBarChart = new Chart(
                            document.getElementById('myWeeklyMultiBarChart'),
                            configMultiBar
                        );
                    </script>
                    </div>
                    <!-- Monthly ride details line chart php -->
                    <?php 
                        $sqlMultiLineMonthly = "SELECT
                                    Month(start_date_time) AS Month,
                                    COUNT(case when status='Completed' then 1 end) AS Completed,
                                    COUNT(case when status='Cancelled' then 1 end) AS Cancelled,
                                    COUNT(*) as Total_Rides
                                FROM tbl_rides
                                GROUP BY Month(start_date_time);";
                        $res = mysqli_query($conn, $sqlMultiLineMonthly);
                        foreach($res as $data)
                        {
                            switch($data['Month']){
                                case 1: $month[] = "January";break;
                                case 2: $month[] = "February";break;
                                case 3: $month[] = "March";break;
                                case 4: $month[] = "April";break;
                                case 5: $month[] = "May";break;
                                case 6: $month[] = "June"; break;
                                case 7: $month[] = "July"; break;
                                case 8: $month[] = "August"; break;
                                case 9: $month[] = "September"; break;
                                case 10: $month[] = "October"; break;
                                case 11: $month[] = "November"; break;
                                case 12: $month[] = "December"; break; 
                                }
                            $CompletedamountMonthly[] = $data['Completed'];
                            $CancelledamountMonthly[] = $data['Cancelled'];
                            $TotalrideamountMonthly[] = $data['Total_Rides'];
                        }
                    ?>
                    <div class="col-sm-12 col-xl-6">
                        <div class="casebox bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Monthly</h6>
                            </div>
                            <canvas id="myMonthlyMultiLineChart"></canvas>
                        </div>
                    </div>
                    <!-- Monthly details chart line Script -->
                    <script>
                        const labelsMultiLine = <?php echo json_encode($month) ?>;
                        const dataMultiLine = {
                            labels: labelsMultiLine,
                            datasets: [{
                            label: 'Completed Rides',
                            data: <?php echo json_encode($CompletedamountMonthly) ?>,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1
                            },{
                            label: 'Cancelled Rides',
                            data: <?php echo json_encode($CancelledamountMonthly) ?>,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgb(255, 159, 64)',
                            borderWidth: 1
                            },{
                            label: 'Total Rides',
                            data: <?php echo json_encode($TotalrideamountMonthly) ?>,
                            backgroundColor:'rgba(51, 153, 255, 0.2)',
                            borderColor: 'rgb(51, 153, 255)',
                            borderWidth: 1
                            }]
                        };

                        const configMultiLine = {
                            type: 'line',
                            data: dataMultiLine,
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            },
                        };

                        var myMultiLineChart = new Chart(
                            document.getElementById('myMonthlyMultiLineChart'),
                            configMultiLine
                        );
                    </script>
                </div>
            </div>
            <!-- Rides Chart End -->


            <!-- Recent Rides Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="casebox bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Rides</h6>
                    </div>
                    <div class="ridestable table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <tr class="tth text-dark">
                                <th scope="col">Booking ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                            </tr>
                            <tbody>
                                <?php 
                                    include 'recentrides.php'; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Cases End -->

            <!-- Start - Footer -->
            <footer id="sticky-footer">
        
                <!-- Copyright -->
                <div class="text-center p-4">
                    © 2022 
                <a class="text-reset fw-bold" href="https://wecycle.travel/">WeCycle</a>
                - All Rights Reserved
                </div>
                <!-- Copyright -->
            </footer>
            <!--End - Footer -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
</body>
</html>