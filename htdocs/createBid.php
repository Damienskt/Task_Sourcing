
<?php
    session_start();
    // Connect to the database. Please change the password and dbname in the following line accordingly
        $_SESSION["user"] = 'sl'; //Person that wants to bid
        $_GET["user"] = 'damien'; // Task owner
        $_GET["taskid"]= 1;
        $db     = pg_connect("host=localhost port=5432 dbname=CS2102 user=postgres password=root");
        $result = pg_query($db, "SELECT * FROM task WHERE taskID = '$_GET[taskid]' AND username = '$_GET[user]'");
        $row = pg_fetch_assoc($result);
        $date = date("Y/m/d");
      if (isset($_POST['bid'])) { 
        $check1 = pg_query($db, "SELECT bidder FROM bid WHERE bidder = '$_SESSION[user]' AND taskid = '$_GET[taskid]'");
        if(pg_num_rows($check1)>0) {
          pg_query("DELETE FROM bid WHERE bidder = '$_SESSION[user]' AND taskid = '$_GET[taskid]'"); //remove duplicates for a specific task as 1 user can only bid once for each task
        }

        $check = pg_query($db, "INSERT INTO bid (taskid,bidder,taskowner,status,biddate,bidamt) VALUES('$_GET[taskid]','$_SESSION[user]','$row[username]','Pending', '$date', '$_POST[Amount]')");
        if($check) 
          $echo1 = '<p>Bid Successful!</p>';
        else {
          $echo1 = '<p>Bid Unsuccessful! Try again!</p>';         
        }
      }
?> 

<!DOCTYPE html>
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
    <a href="homePage.html" class="w3-bar-item w3-button w3-wide">RENTAL</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	  <a href="homePage.html" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
      <a href="aboutUs.html" class="w3-bar-item w3-button"><i class="fa fa-info-circle"></i> ABOUT</a>
      <a href="dashBoard.html" class="w3-bar-item w3-button"><i class="fa fa-user"></i> DASHBOARD</a>;
	  <a href="search.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i> SEARCH</a>
      <a href="contactUs.html" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
    </div>
  </div>
</div>

<!-- Login Section !-->
<div class="w3-container w3-light-grey" style="padding:96px" id="home">
  <h3 class="w3-center">Bid for Task!</h3>
    <p><div class="container">   
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading"><b> <?php echo $row["title"]; ?></b></div>
          <div class="panel-body">
            Type: <?php echo $row["type"]; ?></br>
            Start Date: <?php echo $row["startdate"]; ?></br>
            Start Time: <?php echo $row["starttime"]; ?></br>
            End Date: <?php echo $row["enddate"]; ?></br>
            End Time: <?php echo $row["endtime"]; ?></br>
            Price: <?php echo $row["price"]; ?></br>
            Description: <?php echo $row["description"]; ?></br></br>
          </div>
        </div>
      </div>
    </div>
  </div></p>
  <div class="w3-row-padding" style="margin-top:64px padding:128px 16px">
    <div class="w3-content" align="center">
      <form action="createBid.php" method="POST" >
		    <p><input class="w3-input w3-border" type="number" placeholder="Amount" name="Amount"></p>
          <button class="w3-button w3-white w3-border w3-border-blue" type="submit" name = "bid">
            <i class=" "></i> BID
          </button>
        </p>
      </form>
        <?php echo $echo1; ?>
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