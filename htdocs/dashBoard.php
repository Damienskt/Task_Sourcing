<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<title>CS2102 Assignment</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
body, html {
    height: 100%;
    line-height: 1.8;
}

.w3-bar .w3-button {
    padding: 20px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card-2" id="myNavbar">
    <a href="homePage.php" class="w3-bar-item w3-button w3-wide"> RENTAL</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	  <a href="homePage.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
      <a href="aboutUs.html" class="w3-bar-item w3-button"><i class="fa fa-info-circle"></i> ABOUT</a>
	  <?php
	  if(isset($_SESSION['username'])) {
		  echo '<a href="dashBoard.html" class="w3-bar-item w3-button"><i class="fa fa-user"></i> DASHBOARD</a>';
	  } else {
		  echo '<a href="login.html" class="w3-bar-item w3-button"><i class="fa fa-user"></i> LOGIN</a>';
	  }
	  ?>
	  <a href="search.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i> SEARCH</a>
      <a href="contactUs.html" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
    </div>
  </div>
</div>
<div class="w3-container w3-light-grey" style="padding:96px" id="home">
  <h1 class="w3-center">Welcome <?php echo $_SESSION['username']; ?>!</h1>
  <h4 class="w3-center">Please select what you want to do...</h4>
  <p><a href = "changePassword.html">Change Password </a>
  <p><a href = "createEvent.html">Create New Event </a>
  <p><a href = "viewMyEvent.html">View All Created Events</a>
  <p><a href = "viewBiddedEvents.html">View All Bidded Events</a>
  <p><a href = "logout.html">Logout</a>
  <div class="w3-row-padding" style="margin-top:64px padding:128px 16px">
    <div class="w3-content" align="center">

    </div>
  </div>
</div>	
</body>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>