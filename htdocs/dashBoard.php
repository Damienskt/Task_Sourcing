<!DOCTYPE html>
<?php
	session_start();
?>
<html>
<title>CS2102 Assignment</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

 /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
 .row.content {height: 550px}
 
 /* Set gray background color and 100% height */
 .sidenav {
   background-color: #f1f1f1;
   height: 100%;
 }
     
 /* On small screens, set height to 'auto' for the grid */
 @media screen and (max-width: 767px) {
   .row.content {height: auto;} 
 }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<body>


<?php 
    include 'navbar.php'; //What is this? echo $echo;
?> 

<div class="container-fluid w3-container w3-light-grey" style="padding:96px" id="home">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Dashboard</a></li>
        <li><a href="#">View all</a></li>
        <li><a href="createTask.php">Create new task</a></li>
	<li><a href="viewTask.php">View your task</a></li>
        <li><a href="changePassword.html">Change password</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>Upcoming tasks</h4>
        <table class="table table-hover">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Start Time</th>
            <th>End Time</th>
          </tr>
          <tbody>
            <?php 
              $db = pg_connect("host=localhost port=5432 dbname=CS2102 user=postgres password=root");
              $result = pg_query($db, "SELECT * FROM task 
                WHERE (startDate >= date_trunc('week', CURRENT_TIMESTAMP)
                AND startDate < date_trunc('week', CURRENT_TIMESTAMP + interval '1 week'))"); //query for upcoming tasks for the week
  
              if (pg_num_rows($result) > 0) {
  
                while($row = pg_fetch_array($result)) {
                  echo "<tr> ".
                          "<td> ". $row["title"]. " </td>".
                          "<td> ". $row["description"]. " </td>". 
                          "<td> ". $row["startdate"]. " </td>".
                          "<td> ". $row["enddate"].  "</td>".
                          "<td> ". $row["starttime"]. " </td>".
                          "<td> ". $row["endtime"].  "</td>".
                        "</tr>";
                }
  
              } else {
                echo ("No task this week! Go start one now! \n");
              }
            ?>
        </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Completed</h4>
            <?php
               $db = pg_connect("host=localhost port=5432 dbname=CS2102 user=postgres password=root");
              $result = pg_query($db, "SELECT COUNT (*) AS total FROM task 
                WHERE enddate < date_trunc('day', CURRENT_TIMESTAMP)"); //query for task that have pass the end date
              $data = pg_fetch_assoc($result);

              if ($data["total"] > 0) {
                echo "<p> ". $data["total"] ." </p>";
              } else {
                echo "No task completed.";
              }

            ?>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Accepted</h4>
            <p>100 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Bidded</h4>
            <p>10 Million</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Ratio</h4>
            <p>30%</p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>	
</body>
<?php include 'footer.html' ?>
