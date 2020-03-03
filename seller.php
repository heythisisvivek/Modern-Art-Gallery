<?php 
require("includes/database.php");
session_start();
if(!isset($_SESSION['email'])) {
    header("location: index.php");
} else {
  $localEmail = $_SESSION['email'];
}
?>

<?php
if(isset($_REQUEST['newArt'])) {
    function inValidate($data) {
        $data = trim(stripslashes(htmlspecialchars($data)));
        return $data;
    }

    $uploadImage = "images/siteUploads/" . basename($_FILES["uploadImage"]["name"]);
    $imageName = inValidate($_REQUEST['imageName']);
    $imageAmount = inValidate($_REQUEST['imageAmount']);
    $imageDescription = inValidate($_REQUEST['imageDescription']);
    $inputCategory = inValidate($_REQUEST['inputCategory']);
    $iid = rand();
    $date = date('d/m/Y', time());

    $selUser = "SELECT * FROM users WHERE email = '$localEmail'";
    $selQuery = mysqli_query($conn, $selUser);

    if(mysqli_num_rows($selQuery) > 0) {
        $retrieveUsers = mysqli_fetch_assoc($selQuery);
        $userID = $retrieveUsers['uid'];
        if(move_uploaded_file($_FILES['uploadImage']['tmp_name'], $uploadImage)) {
        $insertNewArt = "INSERT INTO userimages (uid, iid, email, userimage, imagetitle, imagedescription, imageprice, imagecategory, updateDate) VALUES ('$userID', '$iid', '$localEmail', '$uploadImage', '$imageName', '$imageDescription', '$imageAmount', '$inputCategory', '$date')";
        if(mysqli_query($conn, $insertNewArt)) {
            echo "<script>alert('Congratulation! Art Published.')</script>";
        } else {
            echo mysqli_error($conn);
        } } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    } else {
        echo "<script>alert('Error Code: Session Expires')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller</title>
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            <input type="file" name="uploadImage" id="uploadImage" style="display: none" />
            <label for="uploadImage" style="cursor: pointer"><img src="images/siteImages/addimages.png" alt="Upload Image" width=215 height=215></label>
        </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
            <h5>Ready Upload New Image</h5>
            <hr />
            </div>
            <div class="form-group">
            <h5>Image Name:</h5>
            <input type="text" name="imageName" class="form-control" placeholder="Image Name" required />
            </div>
            <h5>Set Amount:</h5>
            <div class="input-group">
            <input type="number" name="imageAmount" class="form-control" placeholder="500" required />
            <div class="input-group-append">
                <span class="input-group-text">₹</span>
            </div>
            </div>
        </div>
        </div>
        <div class="form-group">
        <h5>Image Description:</h5>
        <textarea name="imageDescription" class="form-control" rows="5" placeholder="Briefly Describe your Art in more than 500 characters." required></textarea>
        <br />
        <div class="form-group">
        <label>Art Category</label>
              <select id='inputCategory' name='inputCategory' class='form-control' required>
                  <option>Choose Wisely...</option>
                  <option>Painting</option>
                  <option>Drawing</option>
                  <option>Sculpture</option>
                  <option>Design</option>
                  <option>Graphics</option>
              </select>
              </div>
        </div>
        <div class="form-group">
        <input type="submit" name="newArt" class="btn btn-primary" value="Publish Art" />
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

    <!-- Footer -->
    <?php require("includes/footer.php");?>