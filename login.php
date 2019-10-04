<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body style="background-color:#C2916C">
	<nav class="navbar navbar-fixed-top navbar-expand-lg">
		<div class="container-fluid">
	    	<div class="navbar-header">
	            <a class="navbar-brand name" href="#"><span style="color: #FFF6F0">Albedo</span></a>
	        </div>
	        <div class="collapse navbar-collapse" id="navbar-collapse-3">
            <ul class="nav navbar-nav">
            	<li class="nav-item"><a class="nav-link" href="status_tracking.php" style="color: #FFF6F0">Status Tracking</a></li>
            </ul>
        </div>
	    </div>
	    
	</nav>
		
	    <div class="container mainContainer">
			<!-- Alert went username or password incorrect from loginAction.php-->
			        	<?php 
							    session_start();
							    if(!empty($_SESSION['errMsg'])){
						  			echo "<div class='alert alert-danger'>".$_SESSION['errMsg']."</div>";
						  			session_unset();
						  		}
						 ?>
		    <div class="row">
		      <div class="col-sm-4.5 col-sm-offset-6 form" style="margin-left: 30%;margin-right: 30%;margin-top: 15%;">

		        <form method="POST" action="loginAction.php"> 
		        	<center>
						<!-- <img src="images/logo.jpg" class="img-circle" width="350" height="350" style="margin-top: 20px" /> -->
				    	<h1>Login</h1>	
				    </center>

			        <div class="form-group">
			          	<input type="text" id="username" name="username" class="form-control" placeholder="Username">
			        </div>

			        <div class="form-group">
			          	<input type="password" id="password" name="password" class="form-control" placeholder="Password">
			        </div>

			        <div class="form-group">
			          	<button type="submit" class="col-sm-12 btn btn-primary">Login</button>
			        </div>
		        </form>

		    </div>
		</div>

		<!-- Javascript -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

		<script src="https://use.fontawesome.com/87d2feb52a.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="css/login.css">

</body>
</html>