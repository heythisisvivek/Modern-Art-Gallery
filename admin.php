<?php 
require("includes/database.php");
session_start();
if(!isset($_SESSION['adminLogin'])) {
    header("location: adminlogin.php");
} else {
    $adminLogin = $_SESSION['adminLogin'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/home.css" type="text/css" />
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
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
    </div>

    <!-- Content -->
     
    <div class="container" style='text-align: center; margin-top: 10px'>
    <img class="mb-4" src="images/siteImages/admin.png" alt="" width="80" height="80">
    <h4 style='text-align: center; font-weight: bold; margin: 5px'>Admin Panel</h4>
    <hr />
    <div class='row'>
    <div class='col-md-2'>
    <h4>User Record</h4>
    </div>
    <div class='col-md-7'>
    </div>
    <div class='col-md-3'>
    <h4><?php echo "Current Date: ".date('d/m/y',time());?></h4>
    </div>
    </div>
    <hr />
    <div class='row'>
    <div class='col-md-4'>
    <h5 style='font-weight: bold'>Sold</h5>
    </div>
    <div class='col-md-4'>
    <i class="fas fa-arrows-alt-h"></i>
    </div>
    <div class='col-md-4'>
    <h5 style='font-weight: bold'>Buyed</h5>
    </div>
    </div>
    <hr />
    <?php
        if(mysqli_num_rows($selPurchased = mysqli_query($conn, "SELECT * FROM purchased ORDER BY id DESC")) > 0) {
            while($selPurchasedItem = mysqli_fetch_assoc($selPurchased)) {
                $selPurchasedInfoUid = $selPurchasedItem['uid'];
                $selPurchasedInfoIid = $selPurchasedItem['iid'];
                $selPurchasedInfoEmail = $selPurchasedItem['email'];
                $selPurchasedInfoDate = $selPurchasedItem['date'];
                if(mysqli_num_rows($selUserId = mysqli_query($conn, "SELECT * FROM userImages WHERE iid = '$selPurchasedInfoIid'")) > 0) {
                    $selUserId = mysqli_fetch_assoc($selUserId);
                    $firstTask = $selUserId['uid'];
                    if(mysqli_num_rows($selUserIdInfo = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$firstTask'")) > 0) {
                        $selUserIdInfo = mysqli_fetch_assoc($selUserIdInfo);
                        if(mysqli_num_rows($buyerInfo = mysqli_query($conn, "SELECT * FROM users WHERE email = '$selPurchasedInfoEmail'")) > 0) {
                            $buyerInfoDb = mysqli_fetch_assoc($buyerInfo);
                            echo "
                            <div class='row'>
                            <div class='col-md-4'>
                            <div class='soldBy'>
                            <div class='row'>
                            <div class='col-md-5'>
                            <img src='images/siteImages/seller.png' alt='Sold By' width=100 height=100 style='object-fit: cover'>
                            </div>
                            <div class='col-md-7'>
                            <div><span style='font-weight: bold'>Name:</span> ". $selUserIdInfo['name'] ."</div>
                            <div><span style='font-weight: bold'>Art Name:</span> ". substr($selUserId['imagetitle'],0,10) ."..</div>
                            <div><span style='font-weight: bold'>Credit:</span> ". $selUserId['imageprice'] ." ₹</div>
                            <div><span style='font-weight: bold'>Date:</span> ". $selPurchasedInfoDate ." </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class='col-md-4'>
                            <i class='fas fa-money-bill-wave-alt'></i>
                            <i class='fas fa-arrow-right'></i>
                            </div>
                            <div class='col-md-4'>
                            <div class='buyedBy'>
                            <div class='row'>
                            <div class='col-md-4'>
                            <img src='images/siteImages/admin.png' alt='Sold By' width=100 height=100>
                            </div>
                            <div class='col-md-8'>
                            <div><span style='font-weight: bold'>Name:</span> ". $buyerInfoDb['name'] ."</div>
                            <div><span style='font-weight: bold'>Email:</span> ". $buyerInfoDb['email'] ."</div>
                            <div><span style='font-weight: bold'>Debit:</span> ". $selUserId['imageprice'] ." ₹</div>
                            <div><span style='font-weight: bold'>Date:</span> ". $selPurchasedInfoDate ." </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <hr />
                            ";
                        }       
                    }   
                }
            }
        }
    ?>
    </div>

    <!-- Script -->
    <script src="script/home.js"></script>

    <!-- Footer -->
    <?php require("includes/footer.php");?>