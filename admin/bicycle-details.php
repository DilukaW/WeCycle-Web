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
    <title>Bicycle Details - WeCycle</title>

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

            <?php
                $BikeId = $_GET['BikeId'];

                $qryBikeDetail = "SELECT * FROM tbl_bicycle WHERE id='$BikeId'";
                $resBikeDetail = mysqli_query($conn, $qryBikeDetail);
                if($resBikeDetail)
                {
                    while($row = mysqli_fetch_assoc($resBikeDetail)){
                        $bikeModel = $row['model'];
                        $description = $row['description'];
                        $QRCode = $row['qr_code'];
                    }
                }
                
            ?>

            <!-- Bicycles Details Start -->
            <div class="detailsbox container-fluid bg-light pt-4 px-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4" style="text-align: center;">
                                <h6 class="username mb-0"><b><?php echo $BikeId ?></b></h6>
                            </div>
                            <div class="col-md-2">
                                <img class="userimage me-lg-2" src="data:images/QRCode;base64, <?php echo base64_encode($QRCode); ?>" alt="Profile Pic" style="width: 200px; height: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light text-center rounded p-4">
                        <form method="POST">
                            <div class="row details">
                            <?php
                                if(isset($_SESSION['delete-success'])){
                                    echo $_SESSION['delete-success'];
                                    unset($_SESSION['delete-success']);
                                }
                                if(isset($_SESSION['delete-failed'])){
                                    echo $_SESSION['delete-failed'];
                                    unset($_SESSION['delete-failed']);
                                }
                            ?>
                                
                                <div class="col-md-5">Status</div>
                                <div class="col-md-7">:<span style='background:#39B54A; border-radius:50px; color: #FFF; padding: 1px 5px;'> <b>Available</b> </span>
                                <?php
                                /*
                                    $now = date("Y-m-d h:i:s");
                                    $qryCheckAvailable = "SELECT id,bicycle_id,book_date_time
                                                        FROM tbl_rides 
                                                        WHERE bicycle_id = '$BikeId' AND $now BETWEEN TIMESTAMPADD(MINUTE,10,book_date_time) AND book_date_time";
                                    $resCheckAvailable = mysqli_query($conn,$qryCheckAvailable);
                                    $count = mysqli_fetch_assoc($resCheckAvailable);
                                    if($count > 1)
                                    {
                                        echo "<span style='background:#39B54A; border-radius:50px; color: #FFF; padding: 1px 5px;'> <b>Un Available</b> </span>";
                                    }
                                    else
                                    {
                                        echo "<span style='background:#39B54A; border-radius:50px; color: #FFF; padding: 1px 5px;'> <b>Available</b> </span>";
                                    }
                                   */
                                ?>   
                                </div>
                            </div>
                            <div class="row details">
                                <div class="col-md-5">Bicycle No.</div>
                                <div class="col-md-7">: <span><?php echo $BikeId ?></span> </div>
                           </div>

                           <div class="row details">
                                <div class="col-md-5">Model</div>
                                <div class="col-md-7">: <span><?php echo $bikeModel ?></span> </div>
                            </div>

                           <div class="row details">
                                <div class="col-md-5">Description</div>
                                <div class="col-md-7">: <span><?php echo $description ?></span></div>
                           </div>
                           <div class="ban row">
                                <input type="Submit" id="btnDelete" name="btnDelete" class="banbutton casebox btn" data-toggle="modal" data-target="#example" value="Delete">
                            </div>
                           </form>

                            <?php
                                if(isset($_POST['btnDelete']))
                                {
                                    try{
                                        $qryDeleteBike = "DELETE FROM tbl_bicycle WHERE tbl_bicycle.id='$BikeId'";
                                        $resDelete = mysqli_query($conn, $qryDeleteBike);
                                        if($resDelete)
                                        {
                                            $_SESSION['delete-success'] = "Deleted";
                                        }
                                        else{
                                            $_SESSION['delete-failed'] = "Can not Delete";
                                        }
                                    }
                                    catch(Exception $e){
                                        echo "$e-> getMessage();";
                                    }
                                }
                            ?>
                        </div>
                    </div>
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

    </div>

    <!-- Modal -->
    <!--
    <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Bicycle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure?
            </div>
            <form method="POST" action="">
            <div class="modal-footer">
            <input type="Submit" id="btnDelete" name="btnDelete" class="btn btn-secondary" data-dismiss="modal" value="Yes">
            <input type="button" class="btn btn-primary" value="No">
            </div>
            </form>
            
        </div>
        </div>
    </div>
            -->
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
</body>
</html>