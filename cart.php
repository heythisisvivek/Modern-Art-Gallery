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
    <title>Cart</title>
    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/cart.css" type="text/css" />
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

    <!-- User Cart -->
    <div class="container" style="margin: 10px">
        <h2>Cart</h2>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div>Items</div>
            </div>
            <div class="col-md-2">
                <div>Quantity</div>
            </div>
            <div class="col-md-2">
            <div>Amount</div>
            </div>
            <div class="col-md-2">
            <div>Remove</div>
            </div>
        </div>
        <br />
        <?php 
            if(isset($_REQUEST['removeCart'])) {
                $getUser = trim(htmlspecialchars(stripslashes($_REQUEST['getUser'])));
                $getToremove = trim(htmlspecialchars(stripslashes($_REQUEST['getToremove'])));
                $removeIt = "DELETE FROM cart WHERE iid='$getToremove' and uid='$getUser'";
                if(!mysqli_query($conn, $removeIt)) {
                    echo "<script>alert('Something Went Wrong.')</script>";
                }
            }
            $selUserCart = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$localEmail'");
            if(mysqli_num_rows($selUserCart) > 0) {
                while($retrieveCart = mysqli_fetch_assoc($selUserCart)) {
                echo "
                    <div class='row' style='margin: 10px'>
                    <div class='col-md-6'>
                        <a href='http://localhost/Art%20Gallery/art.php?img=". $retrieveCart['iid'] ."&imgname=". $retrieveCart['arttitle'] ."'><div><img src='".$retrieveCart['image']."' alt='Product Image' style='border: 1px solid grey; padding: 5px; border-radius: 5px; box-shadow: 1px 1px 10px grey' width=80 height=80><span style='font-weight: bold'> Title: </span>".$retrieveCart['arttitle']."</div></a>
                    </div>
                    <div class='col-md-2'>
                        <div><input type='text' value='1' class='form-control' disabled /></div>
                    </div>
                    <div class='col-md-2'>
                    <div>₹".$retrieveCart['artprice'].".00</div>
                    </div>
                    <div class='col-md-2'>
                    <form action='' method='post'>
                    <input type='hidden' name='getUser' value='". $retrieveCart['uid'] ."' />
                    <input type='hidden' name='getToremove' value='". $retrieveCart['iid'] ."' />
                    <input type='submit' name='removeCart' class='btn btn-danger' value='Remove' />
                    </form>
                    </div>
                    </div>       
                ";}
            } else {
                echo "<div style='text-align: center; font-weight: bold'>Nothing in Cart</div>";
            }
            $selUserCartTotalAmount = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$localEmail'");
            echo "
                    <hr />
                    <div class='row' style='margin: 10px'>
                    <div class='col-md-6'>
                    <a href='index.php' class='btn btn-warning'>Continue Shopping</a>
                    </div>
                    <div class='col-md-2'>
                    <span style='font-weight: bold'>Total Amount:</span>
                    </div>
                    <div class='col-md-2'>
                    <div>₹";
            if(mysqli_num_rows($selUserCartTotalAmount) > 0) {
                $calculate = 0;
                while($retrieveCart = mysqli_fetch_assoc($selUserCartTotalAmount)) {
                $calculate = $calculate + $retrieveCart['artprice'];
                }
                echo $calculate;
            }
            echo ".00</div>
                </div>
                <div class='col-md-2'>
                </div>
                </div>       
                ";
        ?>
    </div>

    <!-- Purchased -->
    <?php
        if(isset($_REQUEST['purchased'])) {
            $selUserCart = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$localEmail'");
            if(mysqli_num_rows($selUserCart) > 0) {
                while($retrieveCart = mysqli_fetch_assoc($selUserCart)) {
                    $uid = $retrieveCart['uid'];
                    $iid = $retrieveCart['iid'];
                    $email = $retrieveCart['email'];
                    $date = date('d/m/y', time());
                    $insertCarttoPurchased = "INSERT INTO purchased (uid, iid, email, date) VALUES ('$uid', '$iid', '$email', '$date')";
                    if(!mysqli_query($conn, $insertCarttoPurchased)) {
                        echo "<script>alert('Something Went Wrong')</script>";
                    }
                    $removeIt = "DELETE FROM cart WHERE uid='$uid'";
                    if(mysqli_query($conn, $removeIt)) {
                        // echo "<script>alert('Removed from Cart.')</script>";
                    } else {
                        echo "<script>alert('Something Went Wrong.')</script>";
                    }
                }
                // echo "<script>alert('end')</script>";
        } else {
            echo "<script>alert('Nothing in Cart')</script>";
        }
    }
    ?>
    <!-- CC Area -->
    <div class="col-md-6 offset-md-3">
    <span class="anchor" id="formPayment"></span>
    <hr class="my-5">
    <div class="card card-outline-secondary">
        <div class="card-body">
            <h3 class="text-center">Credit Card Payment</h3>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form" role="form" autocomplete="off">
                <div class="form-group">
                    <label for="cc_name">Card Holder's Name</label>
                    <input type="text" class="form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required">
                </div>
                <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" class="form-control" autocomplete="off" maxlength="20" pattern="\d{16}" title="Credit card number" required="">
                </div>
                <div class="form-group row">
                    <label class="col-md-12">Card Exp. Date</label>
                    <div class="col-md-4">
                        <select class="form-control" name="cc_exp_mo" size="0">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="cc_exp_yr" size="0">
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-12">Amount</label>
                </div>
                <?php 
                $selUserCartTotalAmount = mysqli_query($conn, "SELECT * FROM cart WHERE email = '$localEmail'");
                if(mysqli_num_rows($selUserCartTotalAmount) > 0) {
                    $calculate = 0;
                    while($retrieveCart = mysqli_fetch_assoc($selUserCartTotalAmount)) {
                    $calculate = $calculate + $retrieveCart['artprice'];
                    }
                    echo "
                    <div class='form-inline'>
                    <div class='input-group'>
                    <div class='input-group-prepend'><span class='input-group-text'>$</span></div>
                    <input type='text' class='form-control text-right' value='".$calculate."' id='exampleInputAmount' placeholder='' disabled />
                    <div class='input-group-append'><span class='input-group-text'>.00</span></div>
                    </div>
                    </div>
                    ";}
                ?>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" name="purchased" class="btn btn-success btn-lg btn-block">Pay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="container">
	<div class="row">
        <div class="col-md-6 offset-md-3">
		<div class="paymentCont">
            <div class="paymentWrap">
            <h3 class="headingTop text-center">Trusted Payment Method</h3>	
            <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                <label class="btn paymentMethod active">
                    <div class="method visa"></div>
                    <input type="radio" name="options" checked> 
                </label>
                <label class="btn paymentMethod">
                    <div class="method master-card"></div>
                    <input type="radio" name="options"> 
                </label>
                <label class="btn paymentMethod">
                    <div class="method amex"></div>
                    <input type="radio" name="options">
                </label>
                    <label class="btn paymentMethod">
                    <div class="method vishwa"></div>
                    <input type="radio" name="options"> 
                </label>
                <label class="btn paymentMethod">
                    <div class="method ez-cash"></div>
                    <input type="radio" name="options"> 
                </label>
            </div>        
            </div>
        </div>
        </div>	
    </div>
    </div>
    <br />
    <!-- Footer -->
    <?php require("includes/footer.php");?>