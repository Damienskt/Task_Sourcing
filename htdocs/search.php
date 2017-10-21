	<!DOCTYPE html>
	<?php
		session_start();
	?>
	<html lang="en">
	<head>
		<title>CS2102 Assignment</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

			.w3-bar .w3-button {
				padding: 20px;
			}

			.jumbotron {
				padding-top: 120px;
				padding-bottom: 40px;
				background-color: #FEFEFE;
			}

			.panel {
				text-align: center;
			}

			.pagination {
				display: inline-block;
			}

			.pagination a {
				color: black;
				float: left;
				padding: 8px 16px;
				text-decoration: none;
			}

			.pagination a.active {
				background-color: #4CAF50;
				color: white;
				border: 1px solid #4CAF50;
			}

			.center {
				text-align: center;
			}

			#slidecontainer {
				width: 100%;
			}
			.slider {
				-webkit-appearance: none;
				width: 100%;
				height: 15px;
				border-radius: 5px;
				background: #d3d3d3;
				outline: none;
				opacity: 0.7;
				-webkit-transition: .2s;
				transition: opacity .2s;
			}

			.slider:hover {
				opacity: 1;
			}

			.slider::-webkit-slider-thumb {
				-webkit-appearance: none;
				appearance: none;
				width: 25px;
				height: 25px;
				border-radius: 100%;
				background: #808080;
				cursor: pointer;
			}

			.slider::-moz-range-thumb {
				width: 25px;
				height: 25px;
				border-radius: 100%;
				background: #808080;
				cursor: pointer;
			}

			select {
				width: 100%;
				padding: 12px 12px;
				border: none;
				border-radius: 4px;
				background-color: #f1f1f1;
			}

			input[type=text] {
				width: 100%;
				box-sizing: border-box;
				border: 2px solid #ccc;
				border-radius: 4px;
				font-size: 16px;
				background-color: white;
				padding: 8px 10px 8px 10px;
			}

		</style>
	</head>
	<body>

		<?php
		include 'navbar.php';
		?>

		<div class="jumbotron">
			<div class="container">
				<p>
					<h2 style="text-align: center">Browse over 1,000 taskers with the skills you need</h2></br>
				</p>
				<form action="search.php" method="get">
					<h4>Search for a job:</h4></br>
					<input type="text" name="title" placeholder="By job title">
					<h6>
						<select id="type" name="type">
							<option value="">By type</option>
							<option value="Education">Education</option>
							<option value="Housing Agent">Housing Agent</option>
							<option value="Home">Home</option>
							<option value="Holiday Planner">Holiday Planner</option>
							<option value="Car Washing">Car Washing</option>
							<option value="Miscellaneous">Miscellaneous</option>
						</select>
					</h6></br>
					<div id="slidecontainer">
			            <h6>By Price: Under <span id="price value"></span></h6>
						<input type="range" min="1" max="249" class="slider" id="price" name="price">
					</div></br>
					<button type="submit" class="w3-button w3-grey">Go!</button>
				</form>
			</div>
		</div>

		<?php
		$db     = pg_connect("host=localhost port=5432 dbname=CS2102 user=postgres password=root");
		$page = $_GET["page"];
		if ($page=="" || $page=="1"){
			$page1=0;
		} else {
			$page1 = $page*5-5;
		}
		
		$title = $_GET["title"];
		str_replace("+"," ",$title);
		
		$type = $_GET["type"];
		str_replace("+"," ",$type);
		
		$price = $_GET["price"];
		str_replace("+"," ",$price);

		$filter = array("title"=>$title, "type"=>$type, "price"=>$price);
		$string = "";
		foreach($filter as $field => $value) {
			if ($value == "") {
				continue;
			} else {
				if ($string !== ""){
					$string .= " AND ";
				}
				if ($field == "price"){
					$string = $string . $field . " <= " . $value;
				} else {
					$string = $string . "UPPER(" . $field . ") LIKE UPPER('" . $value . "')";
				}		
			}
		}

		if ($string == ""){
			$result = pg_query($db, "SELECT * FROM task LIMIT 10 OFFSET $page1;");
			$result1 = pg_query($db, "SELECT * FROM task;");
		} else {
			$query = "SELECT * FROM task WHERE " . $string . " LIMIT 10 OFFSET $page1;";
			$query1 = "SELECT * FROM task WHERE " . $string . ";";
			$result = pg_query($db, $query);
			$result1 = pg_query($db, $query1);	
		}

		$row    = pg_fetch_assoc($result);
		while($row = pg_fetch_array($result)){ ?>
			<p><div class="container">   
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-info">
							<div class="panel-heading"><b> <?php echo $row["title"]; ?></b></div>
							<div class="panel-body">
								Type: <?php echo $row["type"]; ?></br>
								Date: <?php echo $row["date"]; ?></br>
								Time: <?php echo $row["time"]; ?></br>
								Price: <?php echo $row["price"]; ?></br>
								Description: <?php echo $row["description"]; ?></br></br>
								<p><a href="search.php?taskid=<?php echo $row["taskid"] ?>&username=<?php echo $row["username"] ?>" class="w3-button w3-white w3-border w3-border-blue">Click here to bid!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div></p>

		<?php 
		}

		$count = pg_num_rows($result1);
		$pages = ceil($count/10);
		if ($page > 1){
			$prevPage = $page - 1;
		} else {
			$prevPage = $page;
		}
		if ($page < $pages){
			$nextPage = $page + 1;
		} else {
			$nextPage = $page;
		}
		?>

	<div class="center">
		<div class="pagination"> 
			<a href="search.php?page=<?php echo $prevPage ?>">&laquo;</a>
			<?php
			for ($a=1; $a<=$pages; $a++){
				if($page == $a || ($page == "" && $a == 1)){
					?>
					<a href="search.php?page=<?php echo $a ?>" class="active"><?php echo "$a"?></a>
					<?php
				} else {
					?>
					<a href="search.php?page=<?php echo $a ?>"><?php echo "$a"?></a>
					<?php 
				}
			}
			?>
			<a href="search.php?page=<?php echo $nextPage ?>">&raquo;</a>
		</div>
	</div>

	<script>
		var slider = document.getElementById("price");
		var output = document.getElementById("price value");

		slider.oninput = function() {
			output.innerHTML = this.value;
		}
	</script>

</body>
</html>
