<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card-2" id="myNavbar">
    <a href="homePage.php" class="w3-bar-item w3-button w3-wide">RENTAL</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	  <a href="homePage.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
	  <?php
	  if(isset($_SESSION['user'])) {
		  echo '<a href="dashBoard.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> DASHBOARD</a>';
	  } else {
		  echo '<a href="login.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> LOGIN</a>';
	  }
	  ?>
      <a href="search.php" class="w3-bar-item w3-button"><i class="fa fa-search"></i> SEARCH</a>
      <a href="credit.html" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CREDIT</a> <!-- Change this name? !-->
    </div>
  </div>
</div>
