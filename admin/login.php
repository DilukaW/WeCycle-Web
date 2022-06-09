<?php 
    include'connection.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WeCycle</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

</head>
<body class="loginbody">
    <!-- Start - Background -->
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
    </div>
    <!-- End - Background -->

    <!--Start - Login Form -->
    <form class="login" method="POST">
        <div class="row" style="margin-bottom: 30px;">
            <!-- Logo -->
            <div class="col-4">
                <img src="images/icon.png" alt="logo" style="width: 90px;">
            </div>
            <!-- Welcome Note -->
            <div class="welcome col-8 align-bottom" style="font-weight: 900; font-size: 35px;">
                Welcome
            </div>
        </div>
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password" placeholder="Password">
        <button id="submit" name="submit">Login</button>
        <!--Login Failed massage -->
        <br/>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-msg']))
            {
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
        ?>
        <br/>
    </form>
    <!--End - Login Form -->

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

  <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php
    //Check whether the submit button clicked or not
    if(isset($_POST['submit']))
    {
        //login process
        //Get data from the form
        $username = $_POST['username'];
        $password = $_POST['password'];
        //Check with the db whether the credientials correct or not
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

        //Execute quary
        $res = mysqli_query($conn, $sql);
        //check user exist or not
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //User available and login success
            //$_SESSION['login'] = "<div>Login Successful</div>" ;
            $_SESSION['user'] = $username;  // To check user still logged in or not
            $_SESSION['pwrd'] = $password;  // To check user still logged in or not

            if($username == "superAdmin" AND $password == "admin123")
            {
                $_SESSION['SuperAdmin'] = "SuperAdmin";
            }else{
                $_SESSION['SuperAdmin'] = "Admin";
            }
            //redirect to dashboard
            header('location:'.SITEURL.'dashboard.php');
        }
        else
        {
            //User not available and login failed
            $_SESSION['login'] = "<div style='color:red'>Username or Password incorrect</div>" ;
            //redirect to dashboard
            header('location:'.SITEURL.'login.php');
        }
    }
    else
    {
        $username = "";
        $password = "";
    }
    mysqli_close($conn);

?>