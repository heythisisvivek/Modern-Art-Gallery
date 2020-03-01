<?php 
require("includes/database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/index.css" type="text/css" />
    <link rel="stylesheet" href="CDN/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- ICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/siteImages/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/siteImages/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/siteImages/favicon-16x16.png">
    <link rel="manifest" href="images/siteImages/site.webmanifest">
    <link rel="mask-icon" href="images/siteImages/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="http://localhost/Art Gallery/"><img src="images/siteImages/android-chrome-192x192.png" width="35" height="35" class="d-inline-block align-top" alt="">Art Gallery</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="http://localhost/Art Gallery/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
          if(!isset($_SESSION['email'])) {
                echo "
            <li class='nav-item'><a class='nav-link' href='signin.php'>Sign In</a></li>
            <li class='nav-item'><a class='nav-link' href='signup.php'>Sign Up</a></li>";
            } else {
                echo "
            <li class='nav-item'><a class='nav-link' href='home.php'>Dashboard</a></li>
            <li class='nav-item'><a class='nav-link' href='cart.php'><i class='fas fa-shopping-cart'></i></a></li>
            <li class='nav-item'><a class='nav-link' href='logout.php'>Sign Out</a></li>";
            }
            ?>
        </ul>
      </div>
    </nav>
    </div>

    <!-- Image Container -->
    <div class="container" style="padding: 20px">
    <h4>All Uploads:</h4>  
    <hr />
    <div class='row'>
    <?php
      $selImage = "SELECT * FROM userimages ORDER BY id desc limit 8";
      $queryImage = mysqli_query($conn, $selImage);

      if(mysqli_num_rows($queryImage) > 0) {
        while($retrieve = mysqli_fetch_assoc($queryImage)) {
            echo "
            <div class='col-md-3'>
              <div class='thumbnail'>
                <a href='http://localhost/Art%20Gallery/art.php?img=".$retrieve['iid']."&imgname=".$retrieve['imagetitle']."'>
                  <img src='".$retrieve['userImage']."' alt='Home Images' style='width:100%'>
                  <div class='caption'>
                    <p style='margin: 5px'>".$retrieve['imagetitle']."</p>
                    <p>₹ ".$retrieve['imageprice']."</p>
                  </div>
                </a>
              </div>
            </div>
            ";
        }
      }
    ?>
    </div>
    </div>

    <!-- Footer -->
    <?php require("includes/footer.php");?>