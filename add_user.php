<?php 
$v_permission_page="login";
require_once 'config/db_connect.php';


date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

$errors = ""; 
$sql = "SELECT * FROM user A 
			LEFT JOIN position B ON A.position_id = B.position_id";
$result = $connect->query($sql);

if(isset($_POST["btnadd"])){
	$v_user 	= $_POST["txtuser"];
	$v_pass 	= $_POST["txtpassword"];
	$v_password	= md5($v_pass );
	$v_position = 3;
	$v_fullname 	= 1;
	$v_sponcer_id 	= 1;
	$v_sponcer_name 	= $_POST["txtsponcername"];

	$sql = "INSERT INTO user (username
							, password 
							, position_id 
							, full_name 
							, date_updated 
										)
						VALUES
							('$v_user'
							, '$v_password'
							, '$v_position'
							, '$v_fullname'
							, '$datetime'
												)";
	$result = mysqli_query($connect, $sql);

	if($result){

			//start insert member downline
			$datetime = date('Y-m-d H:i:s');
			$v_user_from 	= $_POST["txtuser"];
			$v_user_to 	= $_POST["txtpassword"];
			$v_user_to 	= $_POST["txtpassword"];
			$v_user_to 	= $_POST["txtpassword"];

			$sql = "INSERT INTO user (username
									, password 
									, position_id 
												)
								VALUES
									('$v_user'
									, '$v_password'
									, '$datetime'
														)";
			$result = mysqli_query($connect, $sql);
			//end insert member downline

		header('location:register_success.php?message=success');
	}
	
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="style/style.css">
</head>
<body style = "background:lightblue">
<section class="content">
	<div class = "row">
		<div class = "col-md-4 col-md-offset-4 col-xs-12">
			<div class="box box-primary">
			<!-- <?php
			 $query = "SELECT * FROM company where cid = 1";
			 $result1 = mysqli_query($connect, $query);    
			 ?> -->
				<div class="box-header with-border">
				  <h3 class="box-title">
				 Register New User!<?php
				// $row = mysqli_fetch_assoc($result1);
				// 	echo '<strong style="color: #000;"> '.$row['company_name'].'</strong>';
				?> 
				</h3>
				</div>
				<div class = "row">
					<div class = "col-xs-12">
						<center><img src="img/register_image.png"​ class = "img-responsive"></center>
					</div>
				</div>
				<form class="form-horizontal" action = "" method = "post" data-toggle="validator" role="form">
				  <div class="box-body">
				  				<div class="form-group col-xs-12">
									<label for ="">Phone Number:</label>                                          
									<input class="form-control" required name="txtuser" type="text" >    
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Password:</label>                                          
									<input class="form-control" required name="txtpassword" type="text" >    
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Full Name:</label>                                          
									<input class="form-control" required name="txtfullname" type="text" >    
								</div>
								
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Save</button>
                					<a href="index.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
				  </div>
				  
				</form>
			</div>
        </div>
	</div>
</section>
		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<script src="dist/js/validator.min.js"></script>

  
</body>
</html>