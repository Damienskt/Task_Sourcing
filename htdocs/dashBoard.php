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


<?php 
    include 'navbar.php'; //What is this? echo $echo;
?> 

<div class="w3-container w3-light-grey" style="padding:96px" id="home">
  <h1 class="w3-center">Welcome <?php echo $_SESSION['username']; ?>!</h1>
  <h4 class="w3-center">Please select what you want to do...</h4>
  <p><a href = "changePassword.html">Change Password </a>
  <p><a href = "createTask.php">Create New Event </a>
  <p><a href = "viewMyEvent.html">View All Created Events</a>
  <p><a href = "viewBiddedEvents.html">View All Bidded Events</a>
  <p><a href = "logout.php">Logout</a>
  <div class="w3-row-padding" style="margin-top:64px padding:128px 16px">
    <div class="w3-content" align="center">

    </div>
  </div>
</div>	
</body>
<?php include 'footer.html' ?>