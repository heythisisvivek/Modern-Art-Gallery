<?php 
require("includes/database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($_REQUEST['imgname'])) { echo trim(stripslashes(htmlspecialchars($_REQUEST['imgname']))); } else { echo "Art Gallery"; } ?></title>
    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/art.css" type="text/css" />
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
    </div>
    </nav>

    <?php
        if(isset($_REQUEST['img'])) {
            $email = $_SESSION['email'];
            $imgid = trim(stripslashes(htmlspecialchars($_REQUEST['img'])));
            
            // Auto Increase Visit
            $selImage = "SELECT * FROM userimages WHERE iid = '$imgid'";
            $queryImage = mysqli_query($conn, $selImage);
            if(mysqli_num_rows($queryImage) > 0) {
                $retreiveImage = mysqli_fetch_assoc($queryImage);
                $imagevisit = $retreiveImage['imagevisit'] + 1;
                $updateVisit = "UPDATE userimages SET imagevisit = '$imagevisit' WHERE iid = '$imgid'";
                if(!mysqli_query($conn, $updateVisit)) {
                    echo "<script>alert('Unable to Update Visit')</script>";
                }

            // On User Click on Buy Button
            if(isset($_REQUEST['buyArt'])) {
                $localEmail = $_SESSION['email'];

                if(isset($localEmail)) {
                    $getSellerInfo = mysqli_query($conn, "SELECT * FROM userimages WHERE iid = '$imgid'");
                    if(mysqli_num_rows($getSellerInfo) > 0) {
                        $retreiveSellerInfo = mysqli_fetch_assoc($getSellerInfo);
                        $userid = $retreiveSellerInfo['uid'];
                        $imgtitle = $retreiveSellerInfo['imagetitle'];
                        $userImageSold = $retreiveSellerInfo['userImage'];
                        $imgprice = $retreiveSellerInfo['imageprice'];
                        $insertArt = "INSERT INTO cart(iid, uid, email, arttitle, image, artprice) VALUES ('$imgid', '$userid', '$localEmail', '$imgtitle', '$userImageSold', '$imgprice')";
                        if(mysqli_query($conn, $insertArt)) {
                            echo "<script>alert('Added to Cart')</script>";
                        } else {
                            echo "<script>alert('Something Went Wrong')</script>";
                        }
                    }
                } else {
                    header("location: http://localhost/Art%20Gallery/signin.php");
                }
            }

            if(isset($_REQUEST['removeArt'])) {
                $localEmail = $_SESSION['email'];

                if(isset($localEmail)) {
                    $getUserCart = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$localEmail' AND iid = '$imgid'");
                    if(mysqli_num_rows($getUserCart) > 0) {
                        $deleteImg = "DELETE FROM cart WHERE iid='$imgid'";
                        if(mysqli_query($conn, $deleteImg)) {
                            echo "<script>alert('Removed from Cart')</script>";
                        } else {
                            echo "<script>alert('Something Went Wrong')</script>";
                        }
                    }
                } else {
                    header("location: http://localhost/Art%20Gallery/signin.php");
                }
            }
                echo "
                <div class='container' style='margin-top: 30px'>
                <div class='row'>
                    <div class='col-md-5'>
                        <div class='selectedImageContainer'>
                        <img src='".$retreiveImage['userImage']."' style='padding: 5px; border-radius: 5px; border: 1px solid grey; box-shadow: 5px 5px 25px grey' class='selectedImage' alt='Images is Removed' width=400 height=300>
                        </div>
                    </div>
                    <div class='col-md-7'>
                        <h5>Art Name: ".$retreiveImage['imagetitle']."</h5>
                        <h5>Publish Date: ".$retreiveImage['updateDate']."</h5>
                        <h5>Category: ".$retreiveImage['imagecategory']."</h5>
                        <h5>Total Visit: ".$retreiveImage['imagevisit']."</h5><br />
                        ";

                $selCart = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$email' AND iid = '$imgid'");
                if(mysqli_num_rows($selCart) > 0) {
                    echo "<form action='' method='post'><button type='submit' name='removeArt' class='btn btn-danger'>Remove from Cart ₹".$retreiveImage['imageprice']."</button></form><br /><br />";
                } else {
                    echo "<form action='' method='post'><button type='submit' name='buyArt' class='btn btn-primary'>Add to Cart ₹".$retreiveImage['imageprice']."</button></form><br /><br />";
                }
                
                echo "
                    </div>
                </div>
                <div style='margin-top: 10px'>
                    <h5 style='font-weight: bold'>Image Description</h5>
                    <hr />
                    ".$retreiveImage['imagedescription']."
                    <hr />
                </div>
                </div>
                ";
            } else {
                header("location: index.php");
            }
        } else {
            header("location: index.php");
        }
    ?>

    <!-- User Comment -->
    <div class="container">
        <div style="margin: 10px">
        <h5>Comment</h5>
        <?php 
        if(isset($_SESSION['email'])) {
            if(isset($_REQUEST['sendComment'])) {
                $localEmail = $_SESSION['email'];
                $userComment = trim(stripslashes(htmlspecialchars($_REQUEST['userComment'])));

                $getUserInfo = mysqli_query($conn, "SELECT * FROM users WHERE email = '$localEmail'");
                if(mysqli_num_rows($getUserInfo) > 0) {
                    $retreiveUserInfo = mysqli_fetch_assoc($getUserInfo);
                    $cid = rand();
                    $userid = $retreiveUserInfo['uid'];
                    $imageid = $_REQUEST['img'];
                    $name = $retreiveUserInfo['name'] ." ". $retreiveUserInfo['sname'];
                    $email = $retreiveUserInfo['email'];
                    $date = date('d/m/y', time());

                    $insertNewComment = "INSERT INTO comment (cid, uid, iid, name, email, comment, date) VALUES ('$cid', '$userid', '$imageid', '$name', '$email', '$userComment', '$date')";
                    if(!mysqli_query($conn, $insertNewComment)) {
                        echo "<script>alert('Something Went Wrong.')<script>";    
                    }
                } else {
                    echo "<script>alert('Something Getting Wrong.')<script>";
                }

            }

            echo "
            <form action='' method='post'>
            <div class='row'>
                <div class='col-md-10'>
                    <input type='text' name='userComment' value='' placeholder='What is in your mind.' class='form-control' required />
                </div>
                <div class='col-md-2'>
                    <input type='submit' name='sendComment' class='btn btn-primary' value='Comment' />
                </div>
            </div>
            </form>
            ";
        } else {
            echo "<h4 style='background-color: grey; text-align: center; padding: 10px; border-radius: 5px; '>You have to <a href='http://localhost/Art%20Gallery/signin.php'>login</a> before commenting.</h4>";
        }
        ?>
        </div>
        <div style="margin: 10px">
        <?php
            $getImageId = trim(stripslashes(htmlspecialchars($_REQUEST['img'])));
            $selComment = mysqli_query($conn, "SELECT * FROM comment WHERE iid = '$getImageId' ORDER BY id DESC");
            
            if(mysqli_num_rows($selComment) > 0) {
                while($getUserComment = mysqli_fetch_assoc($selComment)) {
                echo "
                    <div class='toast' data-autohide='false'>
                    <div class='toast-header'>
                    <strong class='mr-auto text-primary'>".$getUserComment['name']."</strong>
                    <small class='text-muted'>".$getUserComment['date']."</small>
                    </div>
                    <div class='toast-body'>
                    ".$getUserComment['comment']."
                    </div>
                </div>
                ";}
            } else {
                echo "<div style='text-align: center; font-weight: bold'>Be First to Comment</div>";
            }
        ?>
        </div>
    </div>

    <!-- External Script -->
    <script src="script/art.js"></script>

    <!-- Footer -->
    <?php require("includes/footer.php");?>