<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<title>Albedo: repair tracking</title>
	<script language="javascript">
		function resizeIframe(obj)
		{
			obj.style.height = 0;
    		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  		}
	</script>
</head>
<body>
	
		<!-- -navbar- -->
		<nav class="navbar navbar-expand-lg fixed-top">
			<div class="container">
				  <a class="navbar-brand" href="#">
				  	<img class="logo" src="https://static.wixstatic.com/media/5513c5_d91c857ba761446bacb27c089fe25357~mv2.jpg/v1/crop/x_210,y_241,w_375,h_286/fill/w_172,h_128,al_c,q_80,usm_0.66_1.00_0.01/5513c5_d91c857ba761446bacb27c089fe25357~mv2.webp" title="logo" width="84" height="60" >
				  </a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      <li class="nav-item active">
				        <a class="nav-link" href="#">About us <span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Store</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Collection</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">News & Updates</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Contact us</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Blog</a>
				      </li>
				      <li class="nav-item right">
				        <a class="nav-link" href="#">Register</a>
				      </li>
				    </ul>
				  </div>
			</div>
		</nav>
		<!-- navbar -->

	<div class="container">
		<!-- -======- -->
		<!-- <img class="logo" src="https://static.wixstatic.com/media/5513c5_d91c857ba761446bacb27c089fe25357~mv2.jpg/v1/crop/x_210,y_241,w_375,h_286/fill/w_172,h_128,al_c,q_80,usm_0.66_1.00_0.01/5513c5_d91c857ba761446bacb27c089fe25357~mv2.webp" title="logo" width="100" height="74" > -->
		<!-- <h1><important><div><marquee behavior="alternate" direction="left" scrollamount="9">
			<img src="https://data.whicdn.com/images/267148325/original.gif" width="300" height="97"> -->

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					 
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<form method="post" action="">
						<center><h1>Tracking Repair Status</h1></center><br><br>
								<input type="text" name="form_num" size="7" required="required" class="form-control" placeholder="Form Number">
						<br><br>
								<input type="text" name="cust_tel" required="required" class="form-control" placeholder="Telphone Number">
						<br><br>
								<input type="submit" value="search" name="submit" class="btn btn-success">
						<br><br>
								
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
				<?php
					if(isset($_POST['submit']))
					{
						include ('PHP/connect.php');

						$sql = "SELECT * FROM `repair_order` INNER JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` WHERE `form_num` = '".$_POST['form_num']."';";
						$obj = mysqli_query($conn, $sql);
						$count = mysqli_num_rows($obj);
						if($count > 0)
						{
							$info = mysqli_fetch_assoc($obj);
							
							if($info['tel'] == $_POST['cust_tel'])
							{
								$sql = "SELECT * FROM `repair_item` WHERE `form_num` = '".$_POST['form_num']."';";
								$sqlObj = mysqli_query($conn, $sql);
								$select_item = "";
								while($row = mysqli_fetch_assoc($sqlObj))
								{
									$select_item .= '<option value="'.$row['repair_num'].'">'.$row['repair_num'].'</option>';
								}
								echo '<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form method="post" action="status_tracking_action.php" target="status_info">
										<select class="form-control" name="repair_num">'.$select_item.'</select>
										<input type="submit" value="Display" name="show" class="btn btn-success">
									</form>
								</div>
								<div class="col-md-3"></div>
								</div>';
							} else {
								echo '<div class="row">
								<div class="col-md-3"></div
								<div class="col-md-6">
									<p style="color:#d9534f;">Forn number and telephone number do not match</p></div>
								<div class="col-md-3"></div>
								</div>';
							}
							} else {
								echo '<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-6">
									<p style="color:#d9534f;">Forn number and telephone number do not match</p></div>
								<div class="col-md-3"></div>
								</div>';
							}
					}
				?>

			<!-- <div class="row">
				<div class="col-md-6"> -->
					<iframe name="status_info" frameborder="0" scrolling="no" onload="resizeIframe(this);"></iframe>
				<!-- </div>
			</div> -->
		</div>
	
	</div>
		<footer>
			<div class="col-md-1"></div>
			<div class="col-md-2">© 2017 by Albedo info@albedo-co.com</div>
			<div class="col-md-5"><center><h2 class="brand"> Albédo</h2></center></div>
			<div class="col-md-3">
		<a class="icon" href="#"><img class="icon" src="http://www.freeiconspng.com/uploads/facebook-icon-5.png" title="facebook" width="50" height="50"></a>
		<a class="icon" href="#"><img class="icon" src="http://icons.iconarchive.com/icons/uiconstock/socialmedia/512/Twitter-icon.png" title="twitter" width="50" height="50"></a>
		<a class="icon" href="#"><img class="icon" src="https://maxcdn.icons8.com/Color/PNG/512/Logos/instagram_new-512.png" title="instagram" width="50" height="50"></a>
		<a class="icon" href="#"><img class="icon" src="http://icons.iconarchive.com/icons/designbolts/free-cute-shaded-social/512/Youtube-icon.png" title="youtube" width="50" height="50"></a>
			</div>
			<div class="col-md-1"></div>
		</footer>
	

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		
		<!-- font awesome -->
		<script src="https://use.fontawesome.com/87d2feb52a.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<!-- Javascript in the file -->
		<script src="js/status_tracking.js"></script>

		<!-- JQUERY -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- CSS in the file -->
		<link rel="stylesheet" href="css/status_tracking.css">

</body>
</html>