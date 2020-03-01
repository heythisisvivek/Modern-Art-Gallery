<?php 
require("includes/database.php");
session_start();
if(!isset($_SESSION['email'])) {
    header("location: index.php");
} else {
  $localEmail = $_SESSION['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/home.css" type="text/css" />
    <link rel="stylesheet" href="css/history.css" type="text/css" />
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
     
    <div class="row">
    <div class="col-md-2">
    <div class="right-nav">
    <ul>
    <li><a href="http://localhost/Art%20Gallery/home.php">Dashboard</a></li>
    <li><a href="http://localhost/Art%20Gallery/account.php">Account</a></li>
    <li><a href="http://localhost/Art%20Gallery/testSeller.php">Seller</a></li>
    <li><a href="http://localhost/Art%20Gallery/history.php">History</a></li>
    <li><a href="http://localhost/Art%20Gallery/about.php">About</a></li>
    </ul>
    </div>
    </div>
    <div class="col-md-10">
    <div class="main-content" style="padding: 50px;">
    <div class="container" style="margin: 10px">
        <h2>Publish Art</h2>
        <hr />
        <div class="row">
            <div class="col-md-8">
                <div>Items</div>
            </div>
            <div class="col-md-2">
                <div>Quantity</div>
            </div>
            <div class="col-md-2">
            <div>Amount</div>
            </div>
        </div>
        <br />
        <?php 
            $selUserPurchased = mysqli_query($conn, "SELECT * FROM purchased WHERE email = '$localEmail'");
            if(mysqli_num_rows($selUserPurchased) > 0) {
                while($retrievePurchased = mysqli_fetch_assoc($selUserPurchased)) {
                $iidOfUser = $retrievePurchased['iid'];
                $selUserImages = mysqli_query($conn, "SELECT * FROM userimages WHERE iid = '$iidOfUser'");
                if(mysqli_num_rows($selUserImages) > 0) {
                  while($retrieveCart = mysqli_fetch_assoc($selUserImages)) {
                    echo "
                    <div class='row' style='margin: 10px'>
                    <div class='col-md-6'>
                    <a href='http://localhost/Art%20Gallery/art.php?img=". $retrieveCart['iid'] ."&imgname=". $retrieveCart['imagetitle'] ."'><div><img src='".$retrieveCart['userImage']."' alt='Product Image' style='border: 1px solid grey; padding: 5px; border-radius: 5px; box-shadow: 1px 1px 10px grey' width=80 height=80><span style='font-weight: bold'> Title: </span>".$retrieveCart['imagetitle']."</div></a>
                    </div>
                    <div class='col-md-2'>
                        <div><input type='text' value='1' class='form-control' disabled /></div>
                    </div>
                    <div class='col-md-2'>
                    <div>₹".$retrieveCart['imageprice'].".00</div>
                    </div>
                    <div class='col-md-2'>
                    <div><a href='". $retrieveCart['userImage'] ."' class='btn btn-primary' download>Download</a></div>
                    </div>
                    </div>       
                ";}
                  }}
            } else {
                echo "<div style='text-align: center; font-weight: bold'>Nothing to Show</div>";
            }
        ?>
    </div>
    </div>
    </div>
    </div>
    </div>

    <!-- Footer -->
    <?php require("includes/footer.php");?>