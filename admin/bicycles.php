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
    <title>Bicycles - WeCycle</title>

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
</head>
<body>
    <!-- Start - Background -->
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <!-- End - Background -->
    
    <div class="container-xxl position-relative bg-none d-flex p-0">
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
                    <a href="dashboard.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    
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
                <a href="bicycles.php" class="nav-item nav-link active"><i class="fa fa-bicycle me-2"></i>Bicycles</a>
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
                <a href="#" class="sidebar-toggler flex-shrink-0" style="color: #E31E26;">
                    <i class="fa fa-bars" style="color: white;"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
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

            <!-- Bicycles Details Start -->
            <div class="add row">
                <a class="addbutton btn btn-sm btn-primary" href="add-bicycle.php">Add Bicycle</a>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="casebox bg-light text-center rounded p-4">
                    <form method="POST">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="padding-top: 25px;">Bicycles</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="tth text-dark">
                                    <th scope="col">Bicycle No.</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Desctription</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $qryBikeDetail = "SELECT * FROM tbl_bicycle";
                                $resBikeDetail = mysqli_query($conn, $qryBikeDetail);
                                if(mysqli_num_rows($resBikeDetail)>0)
                                {
                                    while($rows = mysqli_fetch_assoc($resBikeDetail))
                                    {
                                        $bicycleid = $rows['id'];
                                        $modal = $rows['model'];
                                        $description = $rows['description'];
                                    ?>
                                    <tr>
                                        <td><?php echo $bicycleid ?></td>
                                        <td><?php echo $modal ?></td>
                                        <td><?php echo $description ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="bicycle-details.php?BikeId=<?php echo $bicycleid ?>">Details</a>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
            <!-- Bicycles Details End -->

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
