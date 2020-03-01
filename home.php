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
  if(isset($_REQUEST["submit"])) {
    function inValidate($data) {
        $data = trim(stripslashes(htmlspecialchars($data)));
        return $data;
    }

    $uid = rand();
    $name = inValidate($_REQUEST["name"]);
    $sname = inValidate($_REQUEST["sname"]);
    $gender = inValidate($_REQUEST["gender"]);
    $city = inValidate($_REQUEST["city"]);
    $country = inValidate($_REQUEST["country"]);
    
        $udpate = "UPDATE users SET name = '$name', sname = '$sname', gender = '$gender', city = '$city', country = '$country' WHERE email = '$localEmail'";
    
        if(mysqli_query($conn, $udpate)) {
            header("location: home.php");
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }

  }
  
  if(isset($_REQUEST['submitImage'])) {
    $target_dir = "images/userProfiles/";
    $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
    if(move_uploaded_file($_FILES['imageFile']['tmp_name'], $target_file)) {
      $insertImg = "UPDATE users SET profilepic = '$target_file' WHERE email = '$localEmail'";
      if(mysqli_query($conn, $insertImg)) {
        echo "<script>alert('Profile Pic Updated')</script>";
      } else {
        echo "<script>alert('Something Went Wrong')</script>";
      }
    } else {
      echo "<script>alert('Something Went Wrong')</script>";
    }
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
    <form style="margin: auto; text-align: center" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' enctype="multipart/form-data">
      <div class="form-group">
      <img class='pp-preview' src="
      <?php 
        $selTable = "SELECT * FROM users WHERE email='$localEmail'";
        $query = mysqli_query($conn, $selTable);

        if(mysqli_num_rows($query) > 0) {
          $retrieveUser = mysqli_fetch_assoc($query);
          if($retrieveUser['profilepic'] != "") {
            echo $retrieveUser['profilepic'];
          } else {
            echo "http://simpleicon.com/wp-content/uploads/account.png";
          }
        }
      ?>
      " alt='Preview Image' width='200' height='200'/>
      <input type="file" name="imageFile" id="imageFile" />
      </div>
      <div class="row">
      <div class="col-md-6">
      <label for="imageFile" id="imageFileLabel" class="btn btn-primary">Upload</label>
      </div>
      <div class="col-md-1">
      <input type="submit" class="btn btn-success" name="submitImage" value="Submit" />
      </div>
      </div>
    </form>
    <?php 
    $selTable = "SELECT * FROM users WHERE email='$localEmail'";
    $query = mysqli_query($conn, $selTable);

    if(mysqli_num_rows($query) > 0) {
      $retrieveUser = mysqli_fetch_assoc($query);
      echo "    
      <form action='". htmlspecialchars($_SERVER['PHP_SELF']) ."' method='post'>
          <div class='form-row'>
              <div class='col form-group'>
                  <label>First name </label>   
                  <input type='text' value='".$retrieveUser['name']."' name='name' class='form-control' placeholder='' required>
              </div>
              <div class='col form-group'>
                  <label>Last name</label>
                  <input type='text' value='".$retrieveUser['sname']."' name='sname' class='form-control' placeholder=' ' required>
              </div>
          </div> 
          <div class='form-group'>
              "; 
              if($retrieveUser['gender'] == "Male") {
                  echo "
                  <label class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='gender' value='Male' checked=''>
                  <span class='form-check-label'> Male </span>
                  </label>
                  <label class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='gender' value='Female'>
                  <span class='form-check-label'> Female</span>
                  </label>
                  ";
              } else {
                echo "
                <label class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='gender' value='Male'>
                <span class='form-check-label'> Male </span>
                </label>
                <label class='form-check form-check-inline'>
                <input class='form-check-input' type='radio' name='gender' value='Female' checked=''>
                <span class='form-check-label'> Female</span>
                </label>
                ";
              }
        echo"
          </div>
          <div class='form-row'>
              <div class='form-group col-md-6'>
              <label>City</label>
              <input type='text' value='".$retrieveUser['city']."' name='city' class='form-control' required>
              </div>
              <div class='form-group col-md-6'>
              <label>Country</label>
              <select id='inputState' name='country' value='india' class='form-control'>
                  <option> Choose...</option>
                  <option selected=''>".$retrieveUser['country']."</option>
                  <option>Uzbekistan</option>
                  <option>Russia</option>
                  <option>United States</option>
                  <option>India</option>
                  <option>Afganistan</option>
              </select>
              </div>
          </div>
          <div class='form-group' style='width: 100px'>
              <button type='submit' name='submit' class='btn btn-primary btn-block'>Update</button>
          </div> 
      </form>";
    } else {
      header("location: index.php");
    }
    ?>
    </div>
    </div>
    </div>

    <!-- Script -->
    <script src="script/home.js"></script>

    <!-- Footer -->
    <?php require("includes/footer.php");?>