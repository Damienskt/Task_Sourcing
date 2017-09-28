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
    <a href="homePage.php" class="w3-bar-item w3-button w3-wide">RENTAL</a>
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

<!-- Create Task -->
<div class="w3-container w3-light-grey" style="padding:96px" id="home">
  <h3 class="w3-center">CREATE</h3>
  <p class="w3-center w3-large">Create a new task to start!</p>
  <div class="w3-row-padding" style="margin-top:64px padding:128px 16px">
    <div class="w3-content" align="center">
      <form action="createTask.php" method="POST" >
        <p><input class="w3-input w3-border" type="text" placeholder="Task Title" required name="tasktitle"></p>
        <p>
          <textarea class="w3-input w3-border" type="textarea" placeholder="Description of task..." required name="taskdescription"></textarea>
        </p>
        <p>
          <select class="w3-input w3-border" required name = "tasktype">
          <option value = "" disabled> --- Select Task Type --- </option>
          <option value = "Miscellanous "> Miscellanous </option>
          <option value = "Housing Agent "> Housing Agent </option>
          <option value = "Car Washing"> Car Washing </option>
          <option value = "Education "> Education </option>
          <option value = "Holiday Planner "> Holiday Planner </option>
          <option value = "Home"> Home </option>
          </select>
        </p>
        <p>
          <input class="w3-input w3-border" type="number" placeholder="Task Price in SGD" required name="taskprice">
        </p>
        <p>
          <button class="w3-button w3-black" type="submit" name = "create">
            <i class="fa fa-pencil"></i> CREATE
          </button>
        </p>
      </form>
    </div>
  </div>

</div>

<?php
  if(isset($_POST['create'])) {

    // Connect to database. Change pw and dbname as accordingly
    $db = pg_connect("host=localhost port=5432 dbname=TaskSource user=postgres password=test");
    $rn = $_SESSION['username']; // current session user
    $result = pg_query($db, "INSERT INTO task (creator, title, description, type, price) VALUES ('$rn', '$_POST[tasktitle]', '$_POST[taskdescription]', '$_POST[tasktype]', '$_POST[taskprice]')");

    if(!$result) {
      echo "<script> alert('try again') </script>";
    } else {
      echo "<script> alert('Success!') </script>";
    }
  }  
?>

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